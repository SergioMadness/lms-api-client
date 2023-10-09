<?php namespace professionalweb\api\Interfaces\Models\Index;

/**
 * Interface for course index model
 */
interface CourseIndex
{
    /**
     * Get items
     *
     * @return array
     */
    public function getChildren(): array;
}