<?php namespace professionalweb\api\Interfaces\Services;

use professionalweb\api\Interfaces\Models\Pagination;

/**
 * Interface for service to work with courses
 */
interface Courses
{
    /**
     * Get catalog
     *
     * @param int $limit
     * @param int $offset
     *
     * @return Pagination
     */
    public function get(int $limit = 10, int $offset = 0): Pagination;
}