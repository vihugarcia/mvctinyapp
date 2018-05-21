<?php
namespace TinyMVC\database;

class MySQLDB implements IDatabase
{
    private $_connection;

    public function __construct($config) {
        try {
            $this->_connection = new \PDO("mysql:host=".$config['SERVERNAME'].";dbname=".$config['DBNAME'],
                $config['USERNAME'], $config['PASSWORD']);
            $this->_connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            trigger_error("Failed to conencto to database: " . $e->getMessage(),
                E_USER_ERROR);
        }
    }

    /**
     * Get pdo connection
     * @return \pdo pdo connection
     */
    public function getConnection() {
        return $this->_connection;
    }

    /**
     * Gets the records of the specified table
     * @param $table
     * @param $arrFields
     * @return array the resultset
     */
    public function getAll($table, $arrFields)
    {
        if (!empty($arrFields)) {
            $fields = implode(",", $arrFields);
            $sql_query = "SELECT $fields FROM " . $table;
        } else {
            $sql_query = "SELECT * FROM " . $table;
        }

        $conn = $this->getConnection();
        $stmt = $conn->prepare($sql_query);

        $stmt->execute();

        $stmt->setFetchMode(\PDO::FETCH_ASSOC);

        $result = $stmt->fetchAll();

        return $result;
    }

    public function getCount($table)
    {
        $sql_query = "SELECT COUNT(*) 'count' FROM $table";

        $conn = $this->getConnection();
        $stmt = $conn->prepare($sql_query);

        $stmt->execute();

        $stmt->setFetchMode(\PDO::FETCH_ASSOC);

        $result = $stmt->fetchAll();

        return $result;
    }

    public function getItems($table, $arrFields, $offset, $cant)
    {
        if (!empty($arrFields)) {
            $fields = implode(",", $arrFields);
            $sql_query = "SELECT $fields FROM " . $table . " LIMIT $offset, $cant";
        } else {
            $sql_query = "SELECT * FROM " . $table . " LIMIT $offset, $cant";
        }

        $conn = $this->getConnection();
        $stmt = $conn->prepare($sql_query);

        $stmt->execute();

        $stmt->setFetchMode(\PDO::FETCH_ASSOC);

        $result = $stmt->fetchAll();

        return $result;
    }

    /**
     * Get one record of the specified table, determined for the id
     * @param $table
     * @param $arrFields
     * @param $id
     * @return mixed the result row
     */
    public function getOne($table, $arrFields, $key, $id)
    {
        if (!empty($arrFields)) {
            $fields = implode(",", $arrFields);
            $sql_query = "SELECT $fields FROM " . $table . " WHERE $key = :id";
        } else {
            $sql_query = "SELECT * FROM " . $table . " WHERE $key = :id";
        }

        $conn = $this->getConnection();
        $stmt = $conn->prepare($sql_query);
        $stmt->bindParam(':id', $id);

        $stmt->execute();

        $stmt->setFetchMode(\PDO::FETCH_ASSOC);

        $result = $stmt->fetch();

        return $result;
    }

    public function insertOrUpdate($data, $table, $key = null, $id = null)
    {
        $sql_query = " $table SET ";

        foreach ($data as $k => $v) {
            $sql_query .= "$k = '$v',";
        }

        $sql_query = substr($sql_query, 0, strlen($sql_query) - 1);

        if ($id) {
            $sql_query = "UPDATE " . $sql_query . " WHERE $key = :id";
        } else {
            $sql_query = "INSERT INTO " . $sql_query;
        }

        $conn = $this->getConnection();
        $stmt = $conn->prepare($sql_query);

        if ($id) {
            $stmt->bindParam(':id', $id);
        }

        $stmt->execute();

        return true;
    }

    public function insert($data, $table)
    {
        return $this->insertOrUpdate($data, $table);
    }

    public function update($data, $table, $key, $id)
    {
        return $this->insertOrUpdate($data, $table, $key, $id);
    }

    public function query($sql_query)
    {
        $conn = $this->getConnection();
        $stmt = $conn->prepare($sql_query);

        $stmt->execute();

        $stmt->setFetchMode(\PDO::FETCH_ASSOC);

        $result = $stmt->fetchAll();

        return $result;
    }

    public function delete($table, $key, $id)
    {
        $sql_query = "DELETE FROM " . $table . " WHERE $key = :id";

        $conn = $this->getConnection();
        $stmt = $conn->prepare($sql_query);

        $stmt->bindParam(':id', $id);

        $stmt->execute();
    }
}