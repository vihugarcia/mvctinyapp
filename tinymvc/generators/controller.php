<?php
/**
 * This is the template for generating a model class of a specified table
 */

echo "<?php\n";
?>

namespace App\Controllers;

use TinyMVC\core\Controller;
use TinyMVC\database\MySQLDB;
use TinyMVC\helpers\FileUploader;
use TinyMVC\helpers\DataTable;
use TinyMVC\core\DI;

/**
* @Inject view
* @Inject <?= $model ?>
*/
class <?= $controllerName ?> extends Controller
{
    private $db;

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $dataTable = new DataTable([<?= "'".implode("','", $properties)."'" ?>], 'id', '<?= $model ?>');

        $this->view->setAction("index");
        $this->view->set('grid', $dataTable);
        return $this->view->render();
    }

    public function view($id)
    {
        $<?= $model ?> = $this-><?= $model ?>->loadModel($id);

        $this->view->setAction("view");
        $this->view->set('<?= $model ?>', $<?= $model ?>);
        return $this->view->render();
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
            <?php foreach ($properties as $property): ?>
                '<?= $property ?>' => $_POST['<?= $property ?>'],
            <?php endforeach; ?>
            ];

            $this-><?= $model ?>->load($data);

            $this-><?= $model ?>->save();

            return header('Location:/<?= $model ?>');
        }

        $this->view->setAction("add");
        $this->view->set('<?= $model ?>', $this-><?= $model ?>);
        return $this->view->render();
    }

    public function data()
    {
        $params = $_REQUEST;
        $where = "";

        <?php
        $props = $properties;
        array_shift($props);
        $i=0;
        ?>
        $columns = array(
            <?php foreach ($props as $property): ?>
            <?= $i ?> =>'<?= $property ?>',
            <?php $i++ ?>
            <?php endforeach; ?>
            <?= $i ?> => 'id'
        );

        $data = [];

        $queryTot = $queryRec = "SELECT <?= implode(",", $properties) ?> FROM <?= $model ?>s";

        // check search value exist
        if( !empty($params['search']['value']) ) {
            $where .=" WHERE ";
            $where .=" ( <?= $properties[1] ?> LIKE '".$params['search']['value']."%' ";

            <?php for($idx=2;$idx<count($properties);$idx++): ?>
            $where .=" OR <?= $properties[$idx] ?> LIKE '".$params['search']['value']."%' ";
            <?php endfor; ?>

            $queryTot .= $where;
            $queryRec .= $where;
        }

        $queryRec .= " ORDER BY ". $columns[$params['order'][0]['column']]." ".$params['order'][0]['dir']." LIMIT ".$params['start']." ,".$params['length']." ";

        $this->db = DI::getInstanceOf(MySQLDB::class, [CONFIG]);

        $<?= $model ?>s = $this->db->query($queryRec);

        foreach ($<?= $model ?>s as $<?= $model ?>) {
            foreach ($<?= $model ?> as $key => $value) {
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
        $this-><?= $model ?> = $this-><?= $model ?>->loadModel($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
            <?php foreach ($properties as $property): ?>
                '<?= $property ?>' => $_POST['<?= $property ?>'],
            <?php endforeach; ?>
            ];

            $this-><?= $model ?>->load($data);

            $this-><?= $model ?>->save();

            return header('Location:/<?= $model ?>');
        }

        $this->view->setAction("edit");
        $this->view->set('<?= $model ?>', $this-><?= $model ?>);
        return $this->view->render();
    }

    public function delete()
    {
        if (!isset($_POST['id'])) {
            echo "error";
        } else {
            $this-><?= $model ?>->delete((int) $_POST['id']);
            echo "success";
        }
        exit;
    }
}
