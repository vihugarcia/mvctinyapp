<?php
namespace App\Controllers;

use TinyMVC\core\Controller;
use TinyMVC\helpers\FileUploader;
use TinyMVC\helpers\GridHelper;

/**
 * @Inject view
 * @Inject productor
 */
class productorController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($page = 1)
    {
        //$result = $this->productor->all(['nombre', 'apellido', 'dni', 'id_productor']);

        $gridHelper = new GridHelper(['nombre', 'apellido', 'dni', 'id_productor'], 'id_productor', 'productor', $page, $this->productor);
        $this->view->setAction("index");
        //$this->view->set('productors', $result);
        $this->view->set('grid', $gridHelper);
        return $this->view->render();
    }

    public function view($id)
    {
        $productor = $this->productor->loadModel($id);

        $this->view->setAction("view");
        $this->view->set('productor', $productor);
        return $this->view->render();
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'nombre' => $_POST['nombre'],
                'apellido' => $_POST['apellido'],
                'dni' => $_POST['dni'],
                'image' => $_FILES['fileToUpload']['name']
            ];

            $this->productor->load($data);

            $this->productor->save();

            if ( isset($_FILES['fileToUpload']['name']) && !empty($_FILES['fileToUpload']['name']) ) {
                $fileUploader = new FileUploader(ROOT . '/public/uploads', 'fileToUpload');
                $fileUploader->save();
            }
            return header('Location:/productor');
        }

        $this->view->setAction("add");
        $this->view->set('productor', $this->productor);
        return $this->view->render();
    }

    public function edit($id)
    {
        $this->productor = $this->productor->loadModel($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'nombre' => $_POST['nombre'],
                'apellido' => $_POST['apellido'],
                'dni' => $_POST['dni'],
                //'image' => $_FILES['fileToUpload']['name']
            ];

            $this->productor->load($data);

            $this->productor->save($id);

            /*if ( isset($_FILES['fileToUpload']['name']) && !empty($_FILES['fileToUpload']['name']) ) {
                $fileUploader = new FileUploader(ROOT . '/public/uploads', 'fileToUpload');
                $fileUploader->save();
            }*/
            return header('Location:/productor');
        }

        $this->view->setAction("edit");
        $this->view->set('productor', $this->productor);
        return $this->view->render();
    }

    public function delete($id)
    {

    }
}