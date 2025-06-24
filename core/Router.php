<?php

namespace app\core;

class Router
{
    public Request $request;
    public Response $response;
    protected array $routes = [];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }
    public function resolve() //Router uses Request to know what the client is asking for
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;

        if (!$callback) {
            $this->response->setStatusCode(404);
            return "NOT FOUND";
        }
        if(is_string($callback)) {
            $this->renderViews($callback);
            exit;
        }
        return call_user_func($callback);
    }

    private function renderViews($view)
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->viewContent($view);
        echo str_replace("{{content}}", $viewContent, $layoutContent);
    }
    protected function layoutContent() {
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/main.php";
        return ob_get_clean();
    }
    protected function viewContent($view) {
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }
}