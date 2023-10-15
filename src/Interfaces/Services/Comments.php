<?php namespace professionalweb\api\Interfaces\Services;

use professionalweb\api\Interfaces\Models\Comment;

/**
 * Interface for service to work with comments
 */
interface Comments
{
    /**
     * Send comment
     *
     * @param string $taskId
     * @param string $comment
     *
     * @return Comment
     */
    public function send(string $taskId, string $comment): Comment;
}