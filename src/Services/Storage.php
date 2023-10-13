<?php namespace professionalweb\api\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Utils;
use GuzzleHttp\Exception\GuzzleException;
use professionalweb\api\Interfaces\Services\Storage as IStorage;

class Storage implements IStorage
{
    public const METHOD_UPLOAD = 'api/v2/files/temporary';

    public function __construct(
        private Client $client
    )
    {
    }

    /**
     * Upload file
     *
     * @param string $pathToFile
     *
     * @return string
     * @throws GuzzleException
     * @throws \Exception
     */
    public function upload(string $pathToFile): string
    {
        $response = $this->client->post(self::METHOD_UPLOAD, [
            'multipart' => [
                [
                    'name'     => 'file',
                    'contents' => Utils::tryFopen($pathToFile, 'r'),
                ],
            ],
        ]);

        $content = $response->getBody()->getContents();

        if ($response->getStatusCode() >= 400) {
            throw new \Exception($content[0]['error'] ?? '', $response->getStatusCode());
        }

        return $content;
    }
}