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
    protected const METHOD_CATALOG = 'courses';

    protected const METHOD_COURSE = 'courses/:id';

    protected const METHOD_COURSE_INDEX = 'courses/:id/index';

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
     */
    public function get(int $limit = 10, int $offset = 0): Pagination
    {
        $response = $this->client->get(self::METHOD_CATALOG, [
            'query' => [
                'limit'  => $limit,
                'offset' => $offset,
            ],
        ]);

        $content = json_decode($response->getBody()->getContents(), true);

        return new PaginationModel(array_map(function (array $item) {
            return (new Course($item['id'], $item['title']))
                ->setAlias($item['alias'] ?? '')
                ->setNote($item['note'] ?? '')
                ->setDescription($item['description'] ?? '')
                ->setTimeLimit($item['time_limit'] ?? 0)
                ->setCover($item['cover']['big'] ?? '');
        }, $content['data'] ?? []), $content['metadata']['total'], $content['metadata']['currentPage'], $content['metadata']['ipp']);
    }

    public function model(string $id): ICourse
    {
        $response = $this->client->get(str_replace(':id', $id, self::METHOD_COURSE));

        $item = json_decode($response->getBody()->getContents(), true)['data'] ?? [];

        return (new Course($item['id'], $item['title']))
            ->setAlias($item['alias'] ?? '')
            ->setNote($item['note'] ?? '')
            ->setDescription($item['description'] ?? '')
            ->setTimeLimit($item['time_limit'] ?? 0)
            ->setCover($item['cover']['big'] ?? '');
    }

    public function getIndex(string $id): ICourseIndex
    {
        $response = $this->client->get(str_replace(':id', $id, self::METHOD_COURSE_INDEX));

        $items = json_decode($response->getBody()->getContents(), true)['data'] ?? [];

        return new CourseIndex(array_map([$this, 'createIndexItem'], $items));
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
            ->setChildren(array_map([$this, 'createIndexItem'], $item['children']));
    }
}