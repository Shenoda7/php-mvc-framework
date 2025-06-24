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

    public function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}