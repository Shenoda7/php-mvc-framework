<?php

namespace app\models;

use app\core\UserModel;

class User extends UserModel
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    const STATUS_DELETED = -1;

    public int $id; // Automatically populated from the 'id' column in the database result when using fetchObject(static::class)
    public string $created_at; // Automatically populated from the 'created_at' column in the database result when using fetchObject(static::class)
    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public string $password = '';
    public int $status = self::STATUS_INACTIVE;
    public string $confirmPassword = '';

    public function save()
    {
        // password encryption
        $this->status = self::STATUS_ACTIVE;

        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }

    public function rules(): array {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED ,self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class]],
            'password' => [self::RULE_REQUIRED ,[self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' => 13]],
            'confirmPassword' => [self::RULE_REQUIRED ,[self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public static function tableName(): string
    {
        return 'users';
    }
    public function attributes(): array
    {
        return ['firstname', 'lastname', 'email', 'password', 'status'];
    }

    public function labels(): array {
        return [
            'firstname' => 'First name',
            'lastname' => 'Last name',
            'email' => 'Email',
            'password' => 'Password',
            'confirmPassword' => 'Confirm Password',
        ];
    }

    public static function primaryKey(): string {
        return 'id';
    }

    public function getDisplayName(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }

}