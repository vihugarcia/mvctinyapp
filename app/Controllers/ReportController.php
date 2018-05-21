<?php
namespace App\Controllers;

use TinyMVC\core\Controller;
use TinyMVC\core\DI;

/**
 * @Inject view
 */
class ReportController extends Controller
{
    private $db;

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->db = DI::getInstanceOf('TinyMVC\database\MySQLDB', [CONFIG]);

        $tables = $this->db->query("SHOW TABLES");

        $this->view->setAction("index");

        $this->view->set('tables', $tables);
        return $this->view->render();
    }

    public function show()
    {
        print_r($_POST);exit;
    }
}