<?php

namespace app\core;

abstract class Model
{
    public const string RULE_REQUIRED = 'required';
    public const string RULE_EMAIL = 'email';
    public const string RULE_MIN = 'min';
    public const string RULE_MAX = 'max';
    public const string RULE_MATCH = 'match';
    public function loadData($data): void
    {
        foreach ($data as $key => $value) {
            if(property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    abstract public function rules(): array;

    public array $errors = [];
    public function validate(): bool
    {

        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};

            foreach($rules as $rule) {
                $ruleName = $rule;
                if(!is_string($ruleName)) {
                    $ruleName = $rule[0];
                }

                if($ruleName === self::RULE_REQUIRED && !$value) {
                    $this->addError($attribute, self::RULE_REQUIRED);
                }
                if($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($attribute, self::RULE_EMAIL);
                }
                if($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) {
                    $this->addError($attribute, self::RULE_MIN, $rule);
                }
                if($ruleName === self::RULE_MAX && strlen($value) > $rule['max']) {
                    $this->addError($attribute, self::RULE_MAX, $rule);
                } 
                if($ruleName === self::RULE_MATCH && $value != $this->{$rule['match']}) {
                    $this->addError($attribute, self::RULE_MATCH, $rule);
                }
            }
        }
        return empty($this->errors);
    }

    private function addError(string $attribute, string $rule, $params = [])
    {
        $message = $this->errorMessages()[$rule];
        foreach($params as $key => $value) {
            $message = str_replace("{{$key}}", $value, $message);
        }
        $this->errors[$attribute][] = $message;

    }
    public function errorMessages(): array
    {
        return [
            self::RULE_REQUIRED => 'This field is required.',
            self::RULE_EMAIL => 'This field must be a valid email address.',
            self::RULE_MIN => 'This field must be at least {min}.',
            self::RULE_MAX => 'This field must be less than {max}.',
            self::RULE_MATCH => 'This field must be the same as {match}.',
        ];
    }

    public function hasError($attribute) {
        return $this->errors[$attribute] ?? false;
    }
    public function getFirstError($attribute) {
        return $this->errors[$attribute][0] ?? false;
    }

}