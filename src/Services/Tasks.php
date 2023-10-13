<?php namespace professionalweb\api\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use professionalweb\api\Interfaces\Models\Task;
use professionalweb\api\Models\Task as TaskModel;
use professionalweb\api\Interfaces\Services\Tasks as ITasks;

class Tasks implements ITasks
{
    public const METHOD_GET_TASK = 'api/v2/courses/:courseId/tasks/:taskId';

    public function __construct(
        private Client $client
    )
    {
    }

    /**
     * Get task
     *
     * @param string $courseId
     * @param string $taskId
     *
     * @return Task|null
     * @throws GuzzleException
     * @throws \Exception
     */
    public function model(string $courseId, string $taskId): ?Task
    {
        $response = $this->client->get(str_replace([
            ':courseId',
            ':taskId',
        ], [
            $courseId,
            $taskId,
        ], self::METHOD_GET_TASK));

        $content = json_decode($response->getBody()->getContents(), true)['data'] ?? [];

        if ($response->getStatusCode() >= 400) {
            throw new \Exception($content[0]['error'] ?? '', $response->getStatusCode());
        }

        return (new TaskModel())
            ->setId($content['id'])
            ->setTitle($content['title'])
            ->setContent($content['content'])
            ->setAction($content['action'])
            ->setSettings($content['settings'])
            ->setNextTask($content['nextTask'] !== null ? (new TaskModel())->setId($content['nextTask']['id'])->setAlias($content['nextTask']['alias']) : null)
            ->setPrevTask($content['prevTask'] !== null ? (new TaskModel())->setId($content['prevTask']['id'])->setAlias($content['prevTask']['alias']) : null);
    }
}