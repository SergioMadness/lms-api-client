<?php namespace professionalweb\api\Models;

use professionalweb\api\Interfaces\Models\Attempt as IAttempt;

class Attempt implements IAttempt
{
    private string $id;

    private string $progressId;

    private string $taskId;

    private bool $audited;

    private bool $waitAudit;

    private bool $successful;

    private int $mark = 0;

    private array|string $data = [];

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return Attempt
     */
    public function setId(string $id): Attempt
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getProgressId(): string
    {
        return $this->progressId;
    }

    /**
     * @param string $progressId
     *
     * @return Attempt
     */
    public function setProgressId(string $progressId): Attempt
    {
        $this->progressId = $progressId;

        return $this;
    }

    /**
     * @return string
     */
    public function getTaskId(): string
    {
        return $this->taskId;
    }

    /**
     * @param string $taskId
     *
     * @return Attempt
     */
    public function setTaskId(string $taskId): Attempt
    {
        $this->taskId = $taskId;

        return $this;
    }

    /**
     * @return bool
     */
    public function wasAudited(): bool
    {
        return $this->audited;
    }

    /**
     * @param bool $audited
     *
     * @return Attempt
     */
    public function setAudited(bool $audited): Attempt
    {
        $this->audited = $audited;

        return $this;
    }

    /**
     * @return bool
     */
    public function isWaitAudit(): bool
    {
        return $this->waitAudit;
    }

    /**
     * @param bool $waitAudit
     *
     * @return Attempt
     */
    public function setWaitAudit(bool $waitAudit): Attempt
    {
        $this->waitAudit = $waitAudit;

        return $this;
    }

    /**
     * @return bool
     */
    public function isSuccessful(): bool
    {
        return $this->successful;
    }

    /**
     * @param bool $successful
     *
     * @return Attempt
     */
    public function setSuccessful(bool $successful): Attempt
    {
        $this->successful = $successful;

        return $this;
    }

    /**
     * @return int
     */
    public function getMark(): int
    {
        return $this->mark;
    }

    /**
     * @param int $mark
     *
     * @return Attempt
     */
    public function setMark(int $mark): Attempt
    {
        $this->mark = $mark;

        return $this;
    }

    /**
     * @return array|string
     */
    public function getData(): array|string
    {
        return $this->data;
    }

    /**
     * @param array|string $data
     *
     * @return Attempt
     */
    public function setData(array|string $data): Attempt
    {
        $this->data = $data;

        return $this;
    }
}