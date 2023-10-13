<?php namespace professionalweb\api\Interfaces\Models;

/**
 * Login token
 */
interface LoginToken
{
    /**
     * Auth token
     *
     * @return string
     */
    public function getToken(): string;

    /**
     * Token type
     *
     * @return string
     */
    public function getType(): string;

    /**
     * Get token expires int
     *
     * @return int|null
     */
    public function getGetExpiresIn(): ?int;

    /**
     * Get refresh token
     *
     * @return string
     */
    public function getRefreshToken(): string;
}