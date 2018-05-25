<?php
/**
 * This is the template for generating a model class of a specified table
 */

echo "<?php\n";
?>
namespace App\Models;

use TinyMVC\core\Model;

class <?= $modelName ?> extends Model
{
    <?php foreach ($properties as $property): ?>
    private $<?= $property; ?>;
    <?php endforeach; ?>

    protected $rules;

    public function __construct($table, $db)
    {
        parent::__construct($table, $db);

        <?php foreach ($properties as $property): ?>
        $this-><?= $property; ?> = '';
        <?php endforeach; ?>
        $this->key = 'id';
    }

    <?php foreach ($properties as $property): ?>
    public function set<?= ucfirst($property); ?>($<?= $property; ?>)
    {
        $this-><?= $property ?> = $<?= $property ?>;
    }
    <?php endforeach; ?>

    <?php foreach ($properties as $property): ?>
    public function get<?= ucfirst($property) ?>()
    {
        return $this-><?= $property; ?>;
    }
    <?php endforeach; ?>
}
