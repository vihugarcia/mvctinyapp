<?php
namespace TinyMVC\core;

class View
{
    private $variables = [];
    private $controller = '';
    private $action = '';

    public function __construct($controller)
    {
        $this->controller = $controller;
    }

    public function setAction($action)
    {
        $this->action = $action;
    }

    public function set($name, $value)
    {
        $this->variables[$name] = $value;
    }

    public function render()
    {
        extract($this->variables);

        // Enable buffer
        ob_start();
        include ROOT . DS . 'app' . DS . 'Views' . DS . $this->controller . DS. $this->action . '.php';
        $content = ob_get_clean();
        if (file_exists(ROOT . DS . 'app' . DS . 'Views' . DS . 'layouts' . DS . 'main.php')) {
            ob_start();
            include ROOT . DS . 'app' . DS . 'Views' . DS . 'layouts' . DS . 'main.php';
            // Send buffer content to $content variable and disable buffer
            return new Response( ob_get_clean() );
        }

        return new Response( $content );
    }
}