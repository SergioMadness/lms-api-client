<?php namespace professionalweb\api\Models;

use professionalweb\api\Interfaces\Models\Comment as IComment;

/**
 * Comment
 */
class Comment implements IComment
{
    public function __construct(
        private string $id,
        private string $comment,
        private string $createdAt
    )
    {
    }

    /**
     * Get comment id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Get comment text
     *
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * Get comment create date
     *
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}