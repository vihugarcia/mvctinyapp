<?php
require_once "config/config.php";

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TinyMVC\core\DI;
use TinyMVC\database\MySQLDB;

class GenerateModelCommand extends Command
{
    protected $commandName = 'tiny:model';
    protected $commandDescription = "Generates a Model";

    protected $commandArgumentName = "name";
    protected $commandArgumentDescription = "Enter the name of the new model";

    protected function configure()
    {
        $this
            ->setName($this->commandName)
            ->setDescription($this->commandDescription)
            ->addArgument(
                $this->commandArgumentName,
                InputArgument::REQUIRED,
                $this->commandArgumentDescription
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument($this->commandArgumentName);

        $table = $name."s";

        $name = ucfirst($name);

        $modelName = $name;

        $query = "SELECT COLUMN_NAME FROM information_schema.columns WHERE table_name='$table'";

        $db = DI::getInstanceOf(MySQLDB::class, [CONFIG]);

        $result = $db->query($query);

        if (count($result) > 0) {
            $properties = [];

            foreach ($result as $row) {
                foreach ($row as $key => $value) {
                    $properties[] = $value;
                }

            }

            ob_start();
            include 'tinymvc/generators/model.php';
            $content = ob_get_clean();

            $controller = fopen('app/Models/'.$modelName.'.php', "w");
            fwrite($controller, $content);
            fclose($controller);

            $output->writeln("Model $modelName created successfully");

        } else {
            $output->writeln("No table '$table' exits in the database");
        }
    }
}