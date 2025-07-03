<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;

class SiteController extends Controller
{
    public function home()
    {
        $name = Application::$app->user->firstname ?? "";
        $params = [
            'name' => $name,
        ];
        return $this->render('home', $params);
    }
    public function contact()
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