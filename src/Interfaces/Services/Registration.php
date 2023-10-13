<?php namespace professionalweb\api\Interfaces\Services;

use professionalweb\api\Interfaces\Models\LoginToken;

/**
 * Interface for registration service
 */
interface Registration
{
    /**
     * Register by signed data
     *
     * @param string $driver
     * @param array  $data
     * @param string $signature
     *
     * @return LoginToken
     */
    public function bySignedData(string $driver, array $data, string $signature): LoginToken;
}