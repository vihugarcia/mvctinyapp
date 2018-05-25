<?php
namespace TinyMVC\core;

class Model
{
    protected $table;
    public $db;
    private $data;
    protected $key;

    public function __construct($table, $db)
    {
        $this->table = $table;
        $this->db = $db;
    }

    public function all($arrFields = [])
    {
        $result = $this->db->getAll($this->table, $arrFields);

        return $result;
    }

    public function count()
    {
        $result = $this->db->getCount($this->table);

        return $result[0]['count'];
    }

    public function items($arrFields = [], $offset)
    {
        $result = $this->db->getItems($this->table, $arrFields, $offset, 25);

        return $result;
    }

    public function find($id, $arrFields = [])
    {
        $result = $this->db->getOne($this->table, $arrFields, $this->key, $id);

        return $result;
    }

    public function load($data)
    {
        foreach ($data as $k => $v) {
            $this->data[$k] = $this->$k = $v;
        }
    }

    public function loadModel($id)
    {
        $result = $this->find($id);

        $this->load($result);

        return $this;
    }

    public function save($id = null)
    {
        if ($id) {
            $result = $this->db->update($this->data, $this->table, $this->key, $id);

            return $result;
        } else {
            $result = $this->db->insert($this->data, $this->table);

            return $result;
        }
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, $this->key, $id);
    }

    public function __set($name, $value)
    {
        if ( method_exists($this, "set" . ucfirst($name)) ) {
            $method = "set" . ucfirst($name);
            return $this->$method($value);
        }

        return $this->$name = $value;
    }

    public function __get($name)
    {
        if ( method_exists($this, "get" . ucfirst($name)) ) {
            $method = "get" . ucfirst($name);
            return $this->$method();
        }

        return $this->$name;
    }
}