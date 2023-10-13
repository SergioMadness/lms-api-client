<?php namespace professionalweb\api\Interfaces\Services;

use professionalweb\api\Interfaces\Models\LoginToken;

/**
 * Log in user
 */
interface Login
{
    /**
     * Login by e-mail
     *
     * @param string $email
     * @param string $password
     *
     * @return LoginToken
     */
    public function byEmail(string $email, string $password): LoginToken;
}