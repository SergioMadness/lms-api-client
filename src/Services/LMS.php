<?php namespace professionalweb\api\Services;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\CurlHandler;
use professionalweb\api\Interfaces\Services\Comments as IComments;
use professionalweb\api\Interfaces\Services\Registration;
use Psr\Http\Message\RequestInterface;
use professionalweb\api\Interfaces\Services\Tasks;
use professionalweb\api\Interfaces\Services\Courses;
use professionalweb\api\Interfaces\Services\Profile;
use professionalweb\api\Interfaces\Services\Attempts;
use professionalweb\api\Services\Tasks as TasksService;
use professionalweb\api\Services\Profile as ProfileService;
use professionalweb\api\Services\Courses as CoursesService;
use professionalweb\api\Interfaces\Services\Login as ILogin;
use professionalweb\api\Services\Attempts as AttemptsService;
use professionalweb\api\Interfaces\Services\Storage as IStorage;

class LMS
{
    private static string $clientId;

    private static string $authToken;

    private static ?Client $client;

    private static $baseUrl = 'https://api.getlms.online/api/v2/';

    private static string $oauthClientId;

    private static string $oauthClientSecret;

    public static function setOAuthParams(string $clientId, string $clientSecret): void
    {
        self::$oauthClientId = $clientId;
        self::$oauthClientSecret = $clientSecret;
    }

    public static function setClientId(string $clientId): void
    {
        self::$clientId = $clientId;
    }

    public static function getClientId(): string
    {
        return self::$clientId;
    }

    public static function setAuthToken(string $token): void
    {
        self::$authToken = $token;
        self::$client = null;
    }

    public static function setBaseUrl(string $url): void
    {
        self::$baseUrl = $url;
    }

    public static function courses(): Courses
    {
        return new CoursesService(static::getClient());
    }

    public static function tasks(): Tasks
    {
        return new TasksService(static::getClient());
    }

    public static function login(): ILogin|Registration
    {
        return new Login(static::getClient(), self::$oauthClientId, self::$oauthClientSecret);
    }

    public static function profile(): Profile
    {
        return new ProfileService(static::getClient());
    }

    public static function attempts(): Attempts
    {
        return new AttemptsService(static::getClient());
    }

    /**
     * @return IStorage
     */
    public static function storage(): IStorage
    {
        return new Storage(static::getClient());
    }

    /**
     * @return IComments
     */
    public static function comments(): IComments
    {
        return new Comments(static::getClient());
    }

    private static function getClient(): Client
    {
        if (!isset(self::$client)) {
            $stack = new HandlerStack();
            $stack->setHandler(new CurlHandler());
            $stack->push(function (callable $handler) {
                return function (
                    RequestInterface $request,
                    array            $options
                ) use ($handler) {
                    $query = $request->getUri()->getQuery();
                    $request = $request->withUri(
                        $request->getUri()->withQuery($query . (empty($query) ? '' : '&') . 'client_id=' . self::$clientId)
                    );

                    return $handler($request, $options);
                };
            });

            $headers = [
                'Accept' => 'application/json',
            ];
            if (isset(self::$authToken)) {
                $headers['Authorization'] = 'Bearer ' . self::$authToken;
            }
            self::$client = new Client([
                'base_uri' => self::$baseUrl,
                'timeout'  => 30,
                'headers'  => $headers,
                'handler'  => $stack,
            ]);
        }

        return self::$client;
    }
}