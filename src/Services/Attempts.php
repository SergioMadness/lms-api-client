<?php namespace professionalweb\api\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use professionalweb\api\Interfaces\Models\Attempt;
use professionalweb\api\Models\Attempt as AttemptModel;
use professionalweb\api\Interfaces\Services\Attempts as IAttempts;

class Attempts implements IAttempts
{
    public const METHOD_STORE_ATTEMPT = '/api/v2/courses/:courseId/tasks/:taskId/attempt';

    public function __construct(
        private Client $client
    )
    {
    }

    /**
     * Send attempt
     *
     * @param string $courseId
     * @param string $taskId
     * @param string|array  $payload
     *
     * @return Attempt
     * @throws GuzzleException
     * @throws \Exception
     */
    public function send(string $courseId, string $taskId, string|array $payload): Attempt
    {
        $response = $this->client->post(str_replace([
            ':courseId',
            ':taskId',
        ], [
            $courseId,
            $taskId,
        ], self::METHOD_STORE_ATTEMPT), [
            'json' => [
                'answer' => $payload,
            ],
        ]);

        $content = json_decode($response->getBody()->getContents(), true);

        if ($response->getStatusCode() >= 400) {
            throw new \Exception($content[0]['error'] ?? '', $response->getStatusCode());
        }

        return (new AttemptModel())
            ->setId($content['data']['id'])
            ->setProgressId($content['data']['progress_id'])
            ->setTaskId($content['data']['task_id'])
            ->setAudited($content['data']['audited'])
            ->setWaitAudit($content['data']['wait_audit'])
            ->setSuccessful($content['data']['success'])
            ->setMark($content['data']['mark'] ?? 0)
            ->setData($content['data']['data']);
    }
}