<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class SiteController extends Controller
{
    public function home(): void
    {
        $params = [
            'name' => 'shenodaa'
        ];
        $this->render('home', $params);
    }
    public function contact(): void
    {
        $this->render('contact');
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