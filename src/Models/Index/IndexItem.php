<?php namespace professionalweb\api\Models\Index;

use professionalweb\api\Interfaces\Models\Index\IndexItem as IIndexItem;

class IndexItem implements IIndexItem
{

    private string $id;

    private string $type;

    private string $alias;

    private string $title;

    private bool $available;

    private bool $passed;

    private bool $successful;

    private bool $failed;

    private array $children = [];

    /**
     * @param string $id
     *
     * @return IndexItem
     */
    public function setId(string $id): IndexItem
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param string $title
     *
     * @return IndexItem
     */
    public function setTitle(string $title): IndexItem
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param bool $available
     *
     * @return IndexItem
     */
    public function setAvailable(bool $available): IndexItem
    {
        $this->available = $available;

        return $this;
    }

    /**
     * @param bool $passed
     *
     * @return IndexItem
     */
    public function setPassed(bool $passed): IndexItem
    {
        $this->passed = $passed;

        return $this;
    }

    /**
     * @param bool $successful
     *
     * @return IndexItem
     */
    public function setSuccessful(bool $successful): IndexItem
    {
        $this->successful = $successful;

        return $this;
    }

    /**
     * @param bool $failed
     *
     * @return IndexItem
     */
    public function setFailed(bool $failed): IndexItem
    {
        $this->failed = $failed;

        return $this;
    }

    /**
     * @param array $children
     *
     * @return IndexItem
     */
    public function setChildren(array $children): IndexItem
    {
        $this->children = $children;

        return $this;
    }

    public function addChild(IndexItem $item): self
    {
        $this->children[] = $item;

        return $this;
    }

    /**
     * Get task id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Get task name
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Check task is available
     *
     * @return bool
     */
    public function isAvailable(): bool
    {
        return $this->available;
    }

    /**
     * Check task is passed
     *
     * @return bool
     */
    public function isPassed(): bool
    {
        return $this->passed;
    }

    /**
     * Check task passed successfully
     *
     * @return bool
     */
    public function isSuccessful(): bool
    {
        return $this->successful;
    }

    /**
     * Check attempt failed
     *
     * @return bool
     */
    public function isFailed(): bool
    {
        return $this->failed;
    }

    /**
     * Get children
     *
     * @return array
     */
    public function getChildren(): array
    {
        return $this->children;
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
     * @return IndexItem
     */
    public function setAlias(string $alias): IndexItem
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get task type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Set task type
     *
     * @param string $type
     * @return $this
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }
}