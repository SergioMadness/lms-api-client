<?php namespace professionalweb\api\Services;

use GuzzleHttp\Client;
use professionalweb\api\Interfaces\Services\Courses;
use professionalweb\api\Interfaces\Services\Profile;
use professionalweb\api\Interfaces\Services\Attempts;
use professionalweb\api\Services\Courses as CoursesService;

class LMS
{
    private static string $clientId;

    private static string $authToken;

    private static Client $client;

    private static $baseUrl = 'https://api.getlms.online/api/v2';

    public static function setClientId(string $clientId): void
    {
        self::$clientId = $clientId;
    }

    public static function setAuthToken(string $token): void
    {
        self::$authToken = $token;
    }

    public static function courses(): Courses
    {
        return new CoursesService(static::getClient());
    }

    public static function profile(): Profile
    {

    }

    public static function attempts(): Attempts
    {

    }

    private static function getClient(): Client
    {
        if (!isset(self::$client)) {
            $headers = [
                'Accept' => 'application/json',
            ];
            if (isset(self::$authToken)) {
                $headers['Authorization'] = 'Basic ' . self::$authToken;
            }
            self::$client = new Client([
                'base_uri' => self::$baseUrl,
                'timeout'  => 3,
                'headers'  => $headers,
                'query'    => [
                    'client_id' => self::$clientId,
                ],
            ]);
        }

        return self::$client;
    }
}