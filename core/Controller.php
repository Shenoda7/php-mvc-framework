<?php

namespace app\core;

class Controller
{
    public function render($view, $params = []): void {
        Application::$app->router->renderViews($view, $params);
    }
}