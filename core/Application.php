<?php

namespace app\core;

use app\core\db\Database;
use app\core\db\DbModel;

class Application
{
    public string $layout = "main";
    public string $userClass;
    public Request $request;
    public Router $router;
    public Response $response;
    public Session $session;
    public View $view;
    public Database $db;
    public static $ROOT_DIR;
    public static Application $app;
    public ?Controller $controller = null;
    public ?UserModel $user;

    public function __construct($rootPath, array $config)
    {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;

        $this->userClass = $config['userClass'];
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->session = new Session();
        $this->view = new View();

        $this->db = new Database($config['db']);

        $primaryValue = $this->session->get('user');
        if ($primaryValue) {
            $primaryKey = $this->userClass::PrimaryKey();
            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
        } else {
            $this->user = null;
        }
    }

    public function getController(): Controller
    {
        return $this->controller;
    }

    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }

    public function login(UserModel $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey(); // "id"
        $primaryValue = $user->{$primaryKey};

        $this->session->set("user", $primaryValue);


        return true;
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove("user");
    }

    public static function isGuest()
    {
        return !self::$app->user;
    }

    public function run(): void
    {
        try {
            echo $this->router->resolve();
        } catch (\Exception $e) {
            $this->response->setStatusCode($e->getCode());

            echo $this->view->renderView('_error', ['exception' => $e]);
        }
    }
}