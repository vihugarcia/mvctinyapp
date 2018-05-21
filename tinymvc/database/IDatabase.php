<?php
namespace TinyMVC\database;

Interface IDatabase
{
    public function getConnection();

    public function getAll($table, $arrFields);

    public function getCount($table);

    public function getItems($table, $arrFields, $offset, $cant);

    public function getOne($table, $arrFields, $key, $id);

    public function insertOrUpdate($data, $table, $key, $id = null);

    public function insert($data, $table);

    public function update($data, $table, $key, $id);
}