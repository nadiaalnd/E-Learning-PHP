<?php
class Routing
{
    private $routes = [];

    public function set($urlPattern, $controller, $action, $method = 'GET')
    {
        $this->routes[] = [
            'urlPattern' => $urlPattern,
            'controller' => $controller,
            'action' => $action,
            'method' => $method
        ];
    }

    public function run()
    {
        $url = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            if ($route['method'] == $method && $this->matchRoute($route['urlPattern'], $url, $params)) {
                $controllerName = ucfirst($route['controller']);
                $controllerPath = 'Controllers/' . $controllerName . '.php';

                if (file_exists($controllerPath)) {
                    require_once $controllerPath;
                    $controller = new $controllerName();
                    $actionName = $route['action'];

                    if (method_exists($controller, $actionName)) {
                        $controller->$actionName(...$params);
                        return;
                    } else {
                        echo 'Action not found';
                        return;
                    }
                } else {
                    echo 'Controller not found';
                    return;
                }
            }
        }

        http_response_code(404);
        echo 'Route not found';
    }

    private function matchRoute($pattern, $url, &$params)
    {
        $pattern = str_replace('/', '\/', $pattern);
        $pattern = '/^' . $pattern . '$/';

        $matches = [];
        $result = preg_match($pattern, $url, $matches);

        if ($result) {
            $params = array_slice($matches, 1);
        }

        return $result;
    }
}
