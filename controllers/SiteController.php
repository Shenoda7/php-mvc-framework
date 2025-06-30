<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class SiteController extends Controller
{
    public function home(): false|array|string
    {
        $params = [
            'name' => 'shenodaa'
        ];
        return $this->render('home', $params);
    }
    public function contact(): false|array|string
    {
        return $this->render('contact');
    }
    public function handleContact(Request $request): void
    {
        $body = $request->getBody();

        //for testing
        foreach ($body as $key => $value) {
            echo $key . ': ' . $value . "\n";
        }
    }
}