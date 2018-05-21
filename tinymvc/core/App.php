<?php
namespace TinyMVC\core;

use TinyMVC\core\Exceptions\ResourceNotFoundException;

class App
{
    private $matcher;
    private $controllerResolver;

    /**
     * App constructor.
     * @param $matcher
     * ControllerResolverInterface)
     */
    public function __construct($matcher)
    {
        $this->matcher = $matcher;
    }

    public function handle()
    {
        try {
            $resolve = $this->matcher->match();

            $controllerBaseName = explode('\\', $resolve['controller']);
            $controllerBaseName = end($controllerBaseName);
            $controllerBaseName = strtolower( str_replace('Controller','', $controllerBaseName) );

            $db = DI::getInstanceOf('TinyMVC\database\MySQLDB', [CONFIG]);

            // Map the classes that will be injected
            DI::mapClass('view', 'TinyMVC\core\View', [$controllerBaseName]);
            DI::mapClass($controllerBaseName, 'App\Models\\' . ucfirst($controllerBaseName), [$controllerBaseName . "s", $db]);

            // Use the Dependency Injection. Avoid 'new'.
            $controller = DI::getInstanceOf($resolve['controller']);

            return call_user_func_array([$controller, $resolve['action']], $resolve['params']);
        } catch (ResourceNotFoundException $e) {
            return new Response('Not Found', 404);
        } catch (\Exception $e) {
            //print_r($e);exit;
            return new Response('An error occurred', 500);
        }
    }
}