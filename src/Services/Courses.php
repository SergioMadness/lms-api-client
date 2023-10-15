<?php namespace professionalweb\api\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use professionalweb\api\Interfaces\Models\Course as ICourse;
use professionalweb\api\Interfaces\Models\Index\CourseIndex as ICourseIndex;
use professionalweb\api\Interfaces\Models\Index\IndexItem;
use professionalweb\api\Interfaces\Models\Pagination;
use professionalweb\api\Models\Course;
use professionalweb\api\Models\Index\CourseIndex;
use professionalweb\api\Models\Index\IndexItem as IndexItemModel;
use professionalweb\api\Models\Pagination as PaginationModel;
use professionalweb\api\Interfaces\Services\Courses as ICourses;

class Courses implements ICourses
{
    protected const METHOD_CATALOG = 'api/v2/courses';

    protected const METHOD_COURSE = 'api/v2/courses/:id';

    protected const METHOD_COURSE_INDEX = 'api/v2/courses/:id/index';

    public function __construct(
        private Client $client
    )
    {
    }

    /**
     * Get catalog
     *
     * @param int $limit
     * @param int $offset
     *
     * @return Pagination
     * @throws GuzzleException
     * @throws \Exception
     */
    public function get(int $limit = 10, int $offset = 0): Pagination
    {
        $response = $this->client->get(self::METHOD_CATALOG, [
            'query' => [
                'limit' => $limit,
                'offset' => $offset,
            ],
        ]);

        $content = json_decode($response->getBody()->getContents(), true);

        if ($response->getStatusCode() >= 400) {
            throw new \Exception($content[0]['error'] ?? '', $response->getStatusCode());
        }

        return new PaginationModel(array_map(function (array $item) {
            return (new Course($item['id'], $item['title']))
                ->setAlias($item['alias'] ?? '')
                ->setNote($item['note'] ?? '')
                ->setDescription($item['description'] ?? '')
                ->setTimeLimit($item['time_limit'] ?? 0)
                ->setCover($item['cover']['big'] ?? '');
        }, $content['data'] ?? []), $content['metadata']['total'], $content['metadata']['currentPage'], $content['metadata']['ipp']);
    }

    /**
     * @throws GuzzleException
     * @throws \Exception
     */
    public function model(string $id): ICourse
    {
        $response = $this->client->get(str_replace(':id', $id, self::METHOD_COURSE));

        $item = json_decode($response->getBody()->getContents(), true)['data'] ?? [];

        if ($response->getStatusCode() >= 400) {
            throw new \Exception($item[0]['error'] ?? '', $response->getStatusCode());
        }

        return (new Course($item['id'], $item['title']))
            ->setAlias($item['alias'] ?? '')
            ->setNote($item['note'] ?? '')
            ->setDescription($item['description'] ?? '')
            ->setTimeLimit($item['time_limit'] ?? 0)
            ->setCover($item['cover']['big'] ?? '');
    }

    /**
     * @throws GuzzleException
     */
    public function getIndex(string $id): ICourseIndex
    {
        $response = $this->client->get(str_replace(':id', $id, self::METHOD_COURSE_INDEX));

        $items = json_decode($response->getBody()->getContents(), true)['data'] ?? [];
        if ($response->getStatusCode() >= 400) {
            throw new \Exception($items[0]['error'] ?? '', $response->getStatusCode());
        }

        return new CourseIndex($id, array_map([$this, 'createIndexItem'], $items));
    }

    protected function createIndexItem(array $item): IndexItem
    {
        return (new IndexItemModel())
            ->setId($item['id'])
            ->setAvailable($item['isAvailable'])
            ->setFailed($item['isFailed'])
            ->setPassed($item['isPassed'])
            ->setSuccessful($item['isSuccessful'])
            ->setTitle($item['label'])
            ->setAlias($item['alias'])
            ->setType($item['type'])
            ->setChildren(array_map([$this, 'createIndexItem'], $item['children']));
    }
}