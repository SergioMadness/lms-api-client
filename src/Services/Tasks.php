<?php namespace professionalweb\api\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use professionalweb\api\Interfaces\Models\Task;
use professionalweb\api\Models\Task as TaskModel;
use professionalweb\api\Interfaces\Services\Tasks as ITasks;
use professionalweb\bot\Log;

class Tasks implements ITasks
{
    public const METHOD_GET_TASK = 'api/v2/courses/:courseId/tasks/:taskId';

    public const METHOD_GET_CERTIFICATE_IMAGE = 'api/v2/certificates/:courseId/:taskId/image';

    public const METHOD_GET_CERTIFICATE_PDF = 'api/v2/certificates/:courseId/:taskId/pdf';

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

    /**
     * Get path to certificate image
     *
     * @param string $courseId
     * @param string $taskId
     *
     * @return string
     * @throws GuzzleException
     */
    public function getCertificateImage(string $courseId, string $taskId): string
    {
        $response = $this->client->get(str_replace([
            ':courseId',
            ':taskId',
        ], [
            $courseId,
            $taskId,
        ], self::METHOD_GET_CERTIFICATE_IMAGE));

        \professionalweb\bot\Log::info($response);

        if ($response->getStatusCode() >= 400) {
            throw new \Exception($content[0]['error'] ?? '', $response->getStatusCode());
        }

        return $response->getHeader('Location')[0] ?? '';
    }

    /**
     * Get path to PDF with certificate
     *
     * @param string $courseId
     * @param string $taskId
     *
     * @return string
     * @throws GuzzleException
     */
    public function getCertificatePdf(string $courseId, string $taskId): string
    {
        $response = $this->client->get(str_replace([
            ':courseId',
            ':taskId',
        ], [
            $courseId,
            $taskId,
        ], self::METHOD_GET_CERTIFICATE_PDF));

        $content = json_decode($response->getBody()->getContents(), true)['data'] ?? [];

        if ($response->getStatusCode() >= 400) {
            throw new \Exception($content[0]['error'] ?? '', $response->getStatusCode());
        }

        return $content['pdf_path'];
    }
}