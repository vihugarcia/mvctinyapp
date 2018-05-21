<?php
namespace TinyMVC\helpers;

class DataTable
{
    private $data;
    private $cols = [];
    private $key = '';
    private $controller;
    private $page;
    private $model;

    public function __construct($cols, $key, $controller, $page, $model)
    {
        $this->cols = $cols;
        $this->data = $model->items($cols, ($page-1)*10);
        $this->key = $key;
        $this->controller = $controller;
        $this->page = $page;
        $this->model = $model;
    }

    public function render()
    {
        $data = $this->data;
        $cols = $this->cols;
        $controller = $this->controller;
        $key = $this->key;

        ob_start();
        include 'datatableview.php';
        echo ob_get_clean();
    }
}