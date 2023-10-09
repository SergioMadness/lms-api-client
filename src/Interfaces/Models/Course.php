<?php namespace professionalweb\api\Interfaces\Models;

/**
 * Interface for course model
 */
interface Course
{
    /**
     * Get course ID
     *
     * @return string
     */
    public function getId(): string;

    /**
     * Get course title
     *
     * @return string
     */
    public function getTitle(): string;

    /**
     * Get course description
     *
     * @return string
     */
    public function getDescription(): string;

    /**
     * Get course cover
     *
     * @return string
     */
    public function getCover(): string;

    /**
     * Get time limit
     *
     * @return int
     */
    public function getTimeLimit(): int;

    /**
     * Get course alias/uri
     *
     * @return string
     */
    public function getAlias(): string;

    /**
     * Get short description
     *
     * @return string
     */
    public function getNote(): string;
}