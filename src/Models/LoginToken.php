<?php namespace professionalweb\api\Models;

use professionalweb\api\Interfaces\Models\LoginToken as ILoginToken;

class LoginToken implements ILoginToken
{
    public function __construct(
        private string $token,
        private string $refreshToken = '',
        private string $type = 'Bearer',
        private ?int   $expiresIn = null
    )
    {
    }

    /**
     * Auth token
     *
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * Token type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Get token expires int
     *
     * @return int
     */
    public function getGetExpiresIn(): ?int
    {
        return $this->expiresIn ?? 0;
    }

    /**
     * Get refresh token
     *
     * @return string
     */
    public function getRefreshToken(): string
    {
        return $this->refreshToken;
    }
}