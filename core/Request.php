<?php

namespace app\core;

class Request
{
    //the path might be something like this oop.local/users?id=2; so we need the users part until the '?'
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/'; // we don't use php_info becuase apache2 doesn't support it
        $pos = strpos($path, '?'); // if it's false then there's no ? meaning it's the / path
        if (!$pos) {
            return $path;
        }
        return substr($path, 0, $pos);
    }

    public function method(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isPost(): bool {
        return $this->method() == 'post';
    }
    public function isGet(): bool {
        return $this->method() == 'get';
    }
    public function getBody(): array
    {
        $body = [];
        if($this->method() == 'get') {
            foreach($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if($this->method() == 'post') {
            foreach($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        return $body;
    }
}