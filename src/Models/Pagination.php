<?php namespace professionalweb\api\Models;

use professionalweb\api\Interfaces\Models\Pagination as IPagination;

/**
 * Pagination description
 */
class Pagination implements IPagination
{
    public function __construct(
        private array $items,
        private int   $total,
        private int   $currentPage = 0,
        private int   $ipp = 10)
    {
    }

    /**
     * Get current page items
     *
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * Get items qty
     *
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * Current page number
     *
     * @return int
     */
    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    /**
     * Items per page
     *
     * @return int
     */
    public function getIPP(): int
    {
        return $this->ipp;
    }
}