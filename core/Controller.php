<?php

namespace app\core;

class Controller
{
    public string $layout = 'main';
    public function setLayout(string $layout): void
    {
        $this->layout = $layout;
    }
    public function render($view, $params = []): false|array|string
    {
        return Application::$app->router->renderViews($view, $params);
    }
}