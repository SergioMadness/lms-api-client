<?php namespace professionalweb\api\Interfaces\Models\Index;

/**
 * Index item
 */
interface IndexItem
{
    /**
     * Get task id
     *
     * @return string
     */
    public function getId(): string;

    /**
     * Get task type
     *
     * @return string
     */
    public function getType(): string;

    /**
     * @return string
     */
    public function getAlias(): string;

    /**
     * Get task name
     *
     * @return string
     */
    public function getTitle(): string;

    /**
     * Check task is available
     *
     * @return bool
     */
    public function isAvailable(): bool;

    /**
     * Check task is passed
     *
     * @return bool
     */
    public function isPassed(): bool;

    /**
     * Check task passed successfully
     *
     * @return bool
     */
    public function isSuccessful(): bool;

    /**
     * Check attempt failed
     *
     * @return bool
     */
    public function isFailed(): bool;

    /**
     * Get children
     *
     * @return array
     */
    public function getChildren(): array;
}