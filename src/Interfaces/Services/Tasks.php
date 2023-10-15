<?php namespace professionalweb\api\Interfaces\Services;

use professionalweb\api\Interfaces\Models\Task;

/**
 * Interface for service to work with tasks
 */
interface Tasks
{
    /**
     * Get task
     *
     * @param string $courseId
     * @param string $taskId
     *
     * @return Task|null
     */
    public function model(string $courseId, string $taskId): ?Task;

    /**
     * Get path to certificate image
     *
     * @param string $courseId
     * @param string $taskId
     *
     * @return string
     */
    public function getCertificateImage(string $courseId, string $taskId): string;

    /**
     * Get path to PDF with certificate
     *
     * @param string $courseId
     * @param string $taskId
     *
     * @return string
     */
    public function getCertificatePdf(string $courseId, string $taskId): string;
}