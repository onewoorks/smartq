<?php

class Customer_Model {

    public function __construct() {
        $this->db = new Mysql_Driver();
    }

    public function createCustomer(array $values){
        $name = $values['name'];
        $identification_no = $values['identification_no'];
        $address = $values['address'];
        $contact_no = $values['contact_no'];
        $sql = "INSERT INTO customer
                (name,identification_no,address,contact_no) VALUES
                ('$name','$identification_no','$address','$contact_no')";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return $this->db->getLastId();
    }

    public function readCustomer($identification_no){
        $sql = "SELECT * FROM customer WHERE identification_no = '$identification_no' LIMIT 1";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return ($result) ? $result[0] : false;
    }

}