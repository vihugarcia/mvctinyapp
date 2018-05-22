<?php
namespace App\Controllers;

use TinyMVC\core\Controller;
use TinyMVC\helpers\FileUploader;
use TinyMVC\helpers\DataTable;
use TinyMVC\core\DI;

/**
 * @Inject view
 * @Inject client
 */
class ClientController extends Controller
{
    private $db;

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $dataTable = new DataTable(['firstname', 'lastname', 'email', 'id'], 'id', 'client');

        $this->view->setAction("index");
        $this->view->set('grid', $dataTable);
        return $this->view->render();
    }

    public function view($id)
    {
        $client = $this->client->loadModel($id);

        $this->view->setAction("view");
        $this->view->set('client', $client);
        return $this->view->render();
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'firstname' => $_POST['firstname'],
                'lastname' => $_POST['lastname'],
                'email' => $_POST['email'],
                'image' => $_FILES['fileToUpload']['name']
            ];

            $this->client->load($data);

            $this->client->save();

            if ( isset($_FILES['fileToUpload']['name']) && !empty($_FILES['fileToUpload']['name']) ) {
                $fileUploader = new FileUploader(ROOT . '/public/uploads', 'fileToUpload');
                $fileUploader->save();
            }
            return header('Location:/client');
        }

        $this->view->setAction("add");
        $this->view->set('client', $this->client);
        return $this->view->render();
    }

    public function data()
    {
        $params = $_REQUEST;
        $where = "";

        $columns = array(
            0 =>'firstname',
            1 =>'lastname',
            2 =>'email',
            3 =>'id'
        );

        $data = [];

        $queryTot = $queryRec = "SELECT firstname, lastname, email, id FROM clients";

        // check search value exist
        if( !empty($params['search']['value']) ) {
            $where .=" WHERE ";
            $where .=" ( firstname LIKE '".$params['search']['value']."%' ";
            $where .=" OR lastname LIKE '".$params['search']['value']."%' ";
            $where .=" OR email LIKE '".$params['search']['value']."%' )";

            $queryTot .= $where;
            $queryRec .= $where;
        }

        $queryRec .= " ORDER BY ". $columns[$params['order'][0]['column']]." ".$params['order'][0]['dir']." LIMIT ".$params['start']." ,".$params['length']." ";

        $this->db = DI::getInstanceOf('TinyMVC\database\MySQLDB', [CONFIG]);

        $clients = $this->db->query($queryRec);

        foreach ($clients as $client) {
            foreach ($client as $key => $value) {
                $item[] = $value;
            }
            $data[] = $item;
            $item = [];
        }

        $totalRecords = count($this->db->query($queryTot));

        $json_data = array(
            "draw"            => intval( $params['draw'] ),
            "recordsTotal"    => intval( $totalRecords ),
            "recordsFiltered" => intval($totalRecords),
            "data"            => $data   // total data array
        );

        echo json_encode($json_data);  // send data as json format
        exit;
    }

    public function edit($id)
    {
        $this->client = $this->client->loadModel($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'firstname' => $_POST['firstname'],
                'lastname' => $_POST['lastname'],
                'email' => $_POST['email'],
                'image' => $_FILES['fileToUpload']['name']
            ];

            $this->client->load($data);

            $this->client->save($id);

            if ( isset($_FILES['fileToUpload']['name']) && !empty($_FILES['fileToUpload']['name']) ) {
                $fileUploader = new FileUploader(ROOT . '/public/uploads', 'fileToUpload');
                $fileUploader->save();
            }
            return header('Location:/client');
        }

        $this->view->setAction("edit");
        $this->view->set('client', $this->client);
        return $this->view->render();
    }

    public function delete()
    {
        if (!isset($_POST['id'])) {
            echo "error";
        } else {
            $this->client->delete((int) $_POST['id']);
            echo "success";
        }
        exit;
    }
}