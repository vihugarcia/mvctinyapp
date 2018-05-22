<?php
namespace TinyMVC\helpers;

class DataTable
{
    private $cols = [];
    private $key = '';
    private $controller;

    public function __construct($cols, $key, $controller)
    {
        $this->cols = $cols;
        $this->key = $key;
        $this->controller = $controller;
    }

    public function render()
    {
        $cols = $this->cols;
        $controller = $this->controller;
        $key = $this->key;

        ob_start();
        include 'datatableview.php';
        echo ob_get_clean();
    }
}