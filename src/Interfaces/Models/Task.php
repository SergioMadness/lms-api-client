<?php namespace professionalweb\api\Interfaces\Models;

/**
 * Interface for task model
 */
interface Task
{
    /**
     * Get id
     *
     * @return string
     */
    public function getId(): string;

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle(): string;

    /**
     * Get parent id
     *
     * @return string
     */
    public function getParentId(): string;

    /**
     * Get action
     *
     * @return string
     */
    public function getAction(): string;

    /**
     * Get alias
     *
     * @return string
     */
    public function getAlias(): string;

    /**
     * Get task content
     *
     * @return string
     */
    public function getContent(): string;

    /**
     * @return Task|null
     */
    public function getPrevTask(): ?Task;

    /**
     * @return Task|null
     */
    public function getNextTask(): ?Task;

    /**
     * @return array
     */
    public function getSettings(): array;
}