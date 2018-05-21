<?php
namespace TinyMVC\helpers;

class GridHelper
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
        $count = $this->model->count();
        $links = 10;
        $page = $this->page;

        $last       = ceil( $count / 10 );

        $start      = ( ( $this->page - $links ) > 0 ) ? $this->page - $links : 1;
        $end        = ( ( $this->page + $links ) < $last ) ? $this->page + $links : $last;

        ob_start();
        include 'gridview.php';
        echo ob_get_clean();
    }
}