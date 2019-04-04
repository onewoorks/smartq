<?php
header("Access-Control-Allow-Origin: *");
class Mysql_Driver
{

    private $connection;
    private $query;
    private $result;
    private $bind;

    public function connect()
    {
        $host = 'localhost';
        $user = 'DATABASE_USERNAME';
        $password = 'DATABASE_PASSWORD';
        $database = 'DATABASE';
        try {
            $this->connection = new PDO("mysql:host=$host;dbname=$database", $user, $password);
            return true;
        } catch (PDOException $e) {
            $this->connection = null;
            echo $e->getMessage();
            return false;
        }
    }

    public function dc()
    { }

    public function disconnect()
    {
        $this->connection = null;
        return true;
    }

    public function prepare($query)
    {
        $this->query = $query;
        return true;
    }

    public function insertPrepare($query)
    {
        $this->bind = $this->connection->prepare($query);
    }

    public function insertBind($column, $value)
    {
        $this->bind->bindValue($column, $value);
    }

    public function insertExecute()
    {
        $this->bind->execute();
    }

    public function queryexecute()
    {
        if (isset($this->query)) {
            $this->result = $this->connection->query($this->query);

            return true;
        }
        return false;
    }


    public function fetchOut($type = 'object')
    {
        if (isset($this->result)) {
            switch ($type) {
                case 'array':
                    $row = $this->result->fetchAll(PDO::FETCH_ASSOC);
                    break;
                case 'object':
                    $row = $this->result->fetchAll(PDO::FETCH_OBJ);
                    break;
                case 'json';
                    $row = $this->result->fetchAll(PDO::FETCH_ASSOC);
                    break;
                default:
                    //$row = $this->result->fetch_object();
                    $row = $this->result->fetchAll(PDO::FETCH_ASSOC);
                    break;
            }
            return $row;
        }
        $this->disconnect();
        return false;
    }

    public function getLastId()
    {
        return $this->connection->lastInsertId();
    }
}
