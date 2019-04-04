<?php
header("Access-Control-Allow-Origin: *");
class Mysql_Driver {

    private $connection;
    private $query;
    private $result;
    private $bind;

    public function connect() {
        $host= 'localhost';
        $user = 'root';
        $password = 're^mp123';
        $database = 'onewoork_smartq';
        try {
            $this->connection = new PDO("mysql:host=$host;dbname=$database", $user, $password);
            return TRUE;
        } catch (PDOException $e) {
            $this->connection = null;
            echo $e->getMessage();
            return FALSE;
        }
    }

    public function dc(){

    }

    public function disconnect() {
       $this->connection = null;
        return TRUE;
    }

    public function prepare($query) {
        $this->query = $query;
        return TRUE;
    }

    public function insertPrepare($query){
        $this->bind = $this->connection->prepare($query);
    }

    public function insertBind($column,$value){
        $this->bind->bindValue($column,$value);
    }

    public function insertExecute(){
        $this->bind->execute();
    }

    public function queryexecute() {
        if (isset($this->query)) {
            $this->result = $this->connection->query($this->query);

            return TRUE;
        }
        return FALSE;
    }


    public function fetchOut($type = 'object') {
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
        return FALSE;
    }

    public function getLastId(){
        return $this->connection->lastInsertId();
    }

}
