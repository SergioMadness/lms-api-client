<?php namespace professionalweb\api\Models;

use professionalweb\api\Interfaces\Models\Task as ITask;

class Task implements ITask
{
    private string $id;

    private string $title;

    private string $alias;

    private string $parentId;

    private string $action;

    private string $content;

    private array $settings;

    private ?ITask $preTask;

    private ?ITask $nexTask;

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
     * @return Task
     */
    public function setId(string $id): Task
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return Task
     */
    public function setTitle(string $title): Task
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getParentId(): string
    {
        return $this->parentId;
    }

    /**
     * @param string $parentId
     *
     * @return Task
     */
    public function setParentId(string $parentId): Task
    {
        $this->parentId = $parentId;

        return $this;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @param string $action
     *
     * @return Task
     */
    public function setAction(string $action): Task
    {
        $this->action = $action;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     *
     * @return Task
     */
    public function setContent(string $content): Task
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return array
     */
    public function getSettings(): array
    {
        return $this->settings;
    }

    /**
     * @param array $settings
     *
     * @return Task
     */
    public function setSettings(array $settings): Task
    {
        $this->settings = $settings;

        return $this;
    }

    /**
     * @return ITask|null
     */
    public function getPrevTask(): ?ITask
    {
        return $this->preTask;
    }

    /**
     * @param ITask|null $preTask
     *
     * @return Task
     */
    public function setPrevTask(?ITask $preTask): Task
    {
        $this->preTask = $preTask;

        return $this;
    }

    /**
     * @return ITask|null
     */
    public function getNextTask(): ?ITask
    {
        return $this->nexTask;
    }

    /**
     * @param ITask|null $nexTask
     *
     * @return Task
     */
    public function setNextTask(?ITask $nexTask): Task
    {
        $this->nexTask = $nexTask;

        return $this;
    }

    /**
     * @return string
     */
    public function getAlias(): string
    {
        return $this->alias;
    }

    /**
     * @param string $alias
     *
     * @return Task
     */
    public function setAlias(string $alias): Task
    {
        $this->alias = $alias;

        return $this;
    }
}