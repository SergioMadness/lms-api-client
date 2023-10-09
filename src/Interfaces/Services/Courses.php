<?php namespace professionalweb\api\Interfaces\Services;

use professionalweb\api\Interfaces\Models\Index\CourseIndex;
use professionalweb\api\Interfaces\Models\Pagination;
use professionalweb\api\Interfaces\Models\Course as ICourse;

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

    /**
     * Get course by id
     *
     * @param string $id
     *
     * @return ICourse
     */
    public function model(string $id): ICourse;

    /**
     * Get course index
     *
     * @param string $id
     *
     * @return CourseIndex
     */
    public function getIndex(string $id): CourseIndex;
}