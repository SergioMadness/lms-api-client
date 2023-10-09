<?php namespace professionalweb\api\Models;

use professionalweb\api\Interfaces\Models\Course as ICourse;

/**
 * Course model
 */
class Course implements ICourse
{
    private string $description = '';

    private int $timeLimit = 0;

    private string $note = '';

    private string $cover = '';

    private string $alias = '';

    public function __construct(
        private string $id,
        private string $title
    )
    {
    }

    /**
     * @param string $description
     *
     * @return Course
     */
    public function setDescription(string $description): Course
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @param int $timeLimit
     *
     * @return Course
     */
    public function setTimeLimit(int $timeLimit): Course
    {
        $this->timeLimit = $timeLimit;

        return $this;
    }

    /**
     * @param string $note
     *
     * @return Course
     */
    public function setNote(string $note): Course
    {
        $this->note = $note;

        return $this;
    }

    /**
     * @param string $cover
     *
     * @return Course
     */
    public function setCover(string $cover): Course
    {
        $this->cover = $cover;

        return $this;
    }

    /**
     * @param string $alias
     *
     * @return Course
     */
    public function setAlias(string $alias): Course
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get course ID
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Get course title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Get course description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Get course cover
     *
     * @return string
     */
    public function getCover(): string
    {
        return $this->cover;
    }

    /**
     * Get time limit
     *
     * @return int
     */
    public function getTimeLimit(): int
    {
        return $this->timeLimit;
    }

    /**
     * Get course alias/uri
     *
     * @return string
     */
    public function getAlias(): string
    {
        return $this->alias;
    }

    /**
     * Get short description
     *
     * @return string
     */
    public function getNote(): string
    {
        return $this->note;
    }
}