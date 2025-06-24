<?php

namespace app\core;

class Application
{
    public Request $request;
    public Router $router;
    public Response $response;
    public static $ROOT_DIR;
    public function __construct($rootPath)
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        self::$ROOT_DIR = $rootPath;
    }
    public function run() {
        echo $this->router->resolve();
    }
}