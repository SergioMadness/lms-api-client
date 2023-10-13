<?php namespace professionalweb\api\Interfaces\Services;

/**
 * Interface for service to work with files
 */
interface Storage
{
    /**
     * Upload file
     *
     * @param string $pathToFile
     *
     * @return string
     */
    public function upload(string $pathToFile): string;
}