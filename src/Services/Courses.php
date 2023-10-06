<?php namespace professionalweb\api\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use professionalweb\api\Interfaces\Models\Pagination;
use professionalweb\api\Models\Pagination as PaginationModel;
use professionalweb\api\Interfaces\Services\Courses as ICourses;

class Courses implements ICourses
{
    protected const METHOD_CATALOG = '/courses';

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

        return new PaginationModel($content['items'] ?? [], $content['total'], $content['current'], $content['ipp']);
    }
}