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

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }
    public function resolve() //Router uses Request to know what the client is asking for
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;

        if (!$callback) {
            $this->response->setStatusCode(404);
            $this->renderViews("_404");
        }
        if(is_string($callback)) {
            $this->renderViews($callback);
            exit;
        }
        if(is_array($callback)) {
            $callback[0] = new $callback[0]();
        }
        return call_user_func($callback, $this->request);
    }

    public function renderViews($view, $params = []): void
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->viewContent($view, $params);
        echo str_replace("{{content}}", $viewContent, $layoutContent);
    }

    public function renderContent($viewContent, $params = []): void
    {
        $layoutContent = $this->layoutContent();
        echo str_replace("{{content}}", $viewContent, $layoutContent);
    }
    protected function layoutContent(): false|string
    {
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/main.php";
        return ob_get_clean();
    }
    protected function viewContent($view, $params = []): false|string
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }
}