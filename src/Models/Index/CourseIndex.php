<?php namespace professionalweb\api\Models\Index;

use professionalweb\api\Interfaces\Models\Index\IndexItem;
use professionalweb\api\Interfaces\Models\Index\CourseIndex as ICourseIndex;

class CourseIndex implements ICourseIndex
{

    public function __construct(
        private array $items
    )
    {
    }

    /**
     * Get items
     *
     * @return array
     */
    public function getChildren(): array
    {
        return $this->items;
    }

    public function addItem(IndexItem $item): self
    {
        $this->items[] = $item;

        return $this;
    }
}