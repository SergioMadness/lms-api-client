<?php namespace professionalweb\api\Services;

use GuzzleHttp\Client;
use professionalweb\api\Interfaces\Models\User;
use professionalweb\api\Interfaces\Services\Profile as IProfile;
use professionalweb\api\Models\Task as TaskModel;
use professionalweb\api\Models\User as UserModel;

class Profile implements IProfile
{
    public const METHOD_GET_PROFILE = 'api/v2/profile';

    public function __construct(
        private Client $client
    )
    {
    }

    /**
     * Get current user info
     *
     * @return User
     */
    public function getInfo(): User
    {
        $response = $this->client->get(self::METHOD_GET_PROFILE);

        $content = json_decode($response->getBody()->getContents(), true)['data'] ?? [];

        if ($response->getStatusCode() >= 400) {
            throw new \Exception($content[0]['error'] ?? '', $response->getStatusCode());
        }

        return (new UserModel())
            ->setId($content['id'])
            ->setEmail($content['email'])
            ->setFirstName($content['first_name'])
            ->setLastName($content['last_name'] ?? '')
            ->setMiddleName($content['middle_name'] ?? '')
            ->setGender($content['gender'] ? User::GENDER_MALE : User::GENDER_FEMALE);
    }
}