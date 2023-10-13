<?php namespace professionalweb\api\Interfaces\Services;

use professionalweb\api\Interfaces\Models\User;

/**
 * Interface for service to work with current user
 */
interface Profile
{
    /**
     * Get current user info
     *
     * @return User
     */
    public function getInfo(): User;
}