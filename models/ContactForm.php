<?php

namespace app\models;

use shenoda\phpmvc\Model;

class ContactForm extends Model
{
    public string $subject = '';
    public string $email = '';
    public string $body = '';

    public function rules(): array
    {
        return [
            'subject' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED],
            'body' => [self::RULE_REQUIRED],
        ];
    }

    public function labels(): array {
        return [
            'subject' => 'Enter your subject',
            'email' => 'Enter your email',
            'body' => 'Enter your message',
        ];
    }

    public function send() {
        return true;
    }

}