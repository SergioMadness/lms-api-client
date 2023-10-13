<?php namespace professionalweb\api\Interfaces\Models;

/**
 * Interface for Attempt model
 */
interface Attempt
{
    /**
     * Attempt ID
     *
     * @return string
     */
    public function getId(): string;

    /**
     * Progress id
     *
     * @return string
     */
    public function getProgressId(): string;

    /**
     * Task id
     *
     * @return string
     */
    public function getTaskId(): string;

    /**
     * Check attempt was audited
     *
     * @return bool
     */
    public function wasAudited(): bool;

    /**
     * Check attempt waiting for audit
     *
     * @return bool
     */
    public function isWaitAudit(): bool;

    /**
     * Check attempt was successful
     *
     * @return bool
     */
    public function isSuccessful(): bool;

    /**
     * Get mark
     *
     * @return int
     */
    public function getMark(): int;

    /**
     * Get attempt data
     *
     * @return array|string
     */
    public function getData(): array|string;
}