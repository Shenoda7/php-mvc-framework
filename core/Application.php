<?php

namespace app\core;

class Application
{
    public Request $request;
    public Router $router;
    public Response $response;
    public Session $session;
    public Database $db;
    public static $ROOT_DIR;
    public static Application $app;
    public Controller $controller;

    public function __construct($rootPath, array $config)
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->session = new Session();
        $this->db = new Database($config['db']);


        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
    }

    public function getController(): Controller
    {
        return $this->controller;
    }

    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }
    public function run(): void
    {
        echo $this->router->resolve();
    }
}