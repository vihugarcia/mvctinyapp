<?php
namespace TinyMVC\core;

use TinyMVC\core\Exceptions\ResourceNotFoundException;

class Matcher
{
    private $routes = [];
    private $request = '';
    private $resolver = [];

    public function __construct($routes, $request)
    {
        $this->routes = $routes;
        $this->request = $request;
    }

    public function match()
    {
        foreach ($this->routes as $route => $callback) {
            $pattern = '/^' . str_replace('/', '\/', $route) . '$/';

            if (preg_match($pattern, $this->request, $params)) {
                array_shift($params);

                $arrCallback = explode("::", $callback);
                $controller = array_shift($arrCallback);
                $action = array_shift($arrCallback);

                $this->resolver = ['controller' => $controller, 'action' => $action, 'params' => $params];

                return $this->resolver;
            }
        }

        throw new ResourceNotFoundException('Not found', 404);
    }
}