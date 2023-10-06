<?php namespace professionalweb\api\Interfaces\Models;

/**
 * Pagination model
 */
interface Pagination
{
    /**
     * Get current page items
     *
     * @return array
     */
    public function getItems(): array;

    /**
     * Get items qty
     *
     * @return int
     */
    public function getTotal(): int;

    /**
     * Current page number
     *
     * @return int
     */
    public function getCurrentPage(): int;

    /**
     * Items per page
     *
     * @return int
     */
    public function getIPP(): int;
}