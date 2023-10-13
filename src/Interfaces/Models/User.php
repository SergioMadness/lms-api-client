<?php namespace professionalweb\api\Interfaces\Models;

/**
 * Interface for user model
 */
interface User
{
    public const GENDER_MALE = 'male';

    public const GENDER_FEMALE = 'female';

    public function getId(): int;

    public function getEmail(): string;

    public function getFirstName(): string;

    public function getLastName(): string;

    public function getMiddleName(): string;

    public function getGender(): string;
}