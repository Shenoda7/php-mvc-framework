<?php

namespace app\controllers;

use shenoda\phpmvc\Application;
use shenoda\phpmvc\Controller;
use shenoda\phpmvc\middlewares\AuthMiddleware;
use shenoda\phpmvc\Request;
use app\models\LoginForm;
use app\models\User;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(["profile"]));
    }

    public function login(Request $request)
    {
        $loginForm = new LoginForm();
        if ($request->isPost()) {
            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $loginForm->login()) {
                Application::$app->session->setFlash("success", "Logged in successfully");
                Application::$app->response->redirect('/');
                exit;
            }
        }
        $this->setLayout("auth");
        return $this->render("login", ["model" => $loginForm]);
    }

    public function register(Request $request): false|array|string
    {
        $user = new User();
        if ($request->isPost()) {
            $user->loadData($request->getBody());

            if ($user->validate() && $user->save()) {
                Application::$app->response->redirect("/login");
            }

            return $this->render("register", ["model" => $user]);
        }
        $this->setLayout("auth");
        return $this->render("register", ["model" => $user]);
    }

    public function logout(Request $request)
    {
        Application::$app->logout();
        Application::$app->response->redirect("/");
    }

    public function profile()
    {

        return $this->render('profile');
    }
}