<?php namespace professionalweb\api\Interfaces\Models;

/**
 * Interface for comment model
 */
interface Comment
{
    /**
     * Get comment id
     *
     * @return string
     */
    public function getId(): string;

    /**
     * Get comment text
     *
     * @return string
     */
    public function getComment(): string;

    /**
     * Get comment create date
     *
     * @return string
     */
    public function getCreatedAt(): string;
}