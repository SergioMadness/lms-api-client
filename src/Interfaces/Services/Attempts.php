<?php namespace professionalweb\api\Interfaces\Services;

use professionalweb\api\Interfaces\Models\Attempt;

/**
 * Interface for service to work with attempts
 */
interface Attempts
{
    /**
     * Send attempt
     *
     * @param string       $courseId
     * @param string       $taskId
     * @param string|array $payload
     *
     * @return Attempt
     */
    public function send(string $courseId, string $taskId, string|array $payload): Attempt;
}