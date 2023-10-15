<?php namespace professionalweb\api\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use professionalweb\api\Interfaces\Models\Comment;
use professionalweb\api\Models\Comment as CommentModel;
use professionalweb\api\Interfaces\Services\Comments as IComments;

/**
 * Service to work with comments
 */
class Comments implements IComments
{
    public const METHOD_SEND_COMMENT = 'api/v2/comments';

    public function __construct(
        private Client $client
    )
    {
    }

    /**
     * Create comment
     *
     * @param string $taskId
     * @param string $comment
     *
     * @return Comment
     * @throws GuzzleException
     */
    public function send(string $taskId, string $comment): Comment
    {
        $response = $this->client->post(self::METHOD_SEND_COMMENT, [
            'json' => [
                'itemId'   => $taskId,
                'itemType' => 'task',
                'comment'  => $comment,
            ],
        ]);

        $content = json_decode($response->getBody()->getContents(), true)['data'] ?? [];

        if ($response->getStatusCode() >= 400) {
            throw new \Exception($content[0]['error'] ?? '', $response->getStatusCode());
        }

        return (new CommentModel($content['id'], $content['comment'], $content['created_at']));
    }
}