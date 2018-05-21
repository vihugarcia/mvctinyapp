<?php
namespace App\Models;

use TinyMVC\core\Model;

class Client extends Model
{
    private $firstname;
    private $lastname;
    private $email;

    protected $rules;

    public function __construct($table, $db)
    {
        parent::__construct($table, $db);

        $this->firstname = '';
        $this->lastname = '';
        $this->email = '';
        $this->key = 'id';
    }

    public function setFirstName($firstName)
    {
        $this->firstname = $firstName;
    }

    public function setLastName($lastName)
    {
        $this->lastname = $lastName;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getFirstName()
    {
        return $this->firstname;
    }

    public function getLastName()
    {
        return $this->lastname;
    }

    public function getEmail()
    {
        return $this->email;
    }
}