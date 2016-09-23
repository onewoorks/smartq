<?php

class Queue_Model {

    public $org_id;
    public $code_authorize;

    public function __construct() {
        $this->db = new Mysql_Driver();
        $this->failedQueue();
    }

    public function readAllActiveQueue() {
        $sql = "SELECT q.*,c.*
                FROM queue q
                LEFT JOIN customer c ON c.id=q.customer_id";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return $this->db->fetchOut('array');
    }

    public function readLastOrganisationQueNo($orgid) {
        $sql = "SELECT q.queue_no, c.* FROM queue q
                LEFT JOIN customer c ON c.id=q.customer_id
                WHERE q.org_id='" . (int) $orgid . "'
                AND DATE(q.timestamp) = DATE(now()) ORDER BY q.timestamp DESC
                LIMIT 1";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return ($result) ? $result[0]['queue_no'] : false;
    }

    public function createQueue(array $values) {
        $org_id = $values['org_id'];
        $queno = $this->generateQueno($org_id);
        $status = 'noshow';
        $customer_id = $values['customer_id'];
        $register_type = $values['register_type'];
        $customer_ip = $_SERVER['REMOTE_ADDR'];
        $show_status = null;
        $code_authorize = $values['code_authorize'];
        $sql = "INSERT INTO queue
                (org_id,queue_no,status,customer_id,register_type,ip,show_status,code_authorize) VALUES
                ('$org_id','$queno','$status','$customer_id','$register_type','$customer_ip','$show_status','$code_authorize')";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return $queno;
    }

    private function checkCode() {
        $sql = "SELECT * FROM queue WHERE code_authorize='$this->code_authorize' AND org_id='$this->org_id'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return ($result) ? $result[0] : false;
    }

    public function failedQueue(){
        $query = "UPDATE queue SET status='failed-to-arrive' WHERE DATE(timestamp) < DATE(now())";
        $this->db->connect();
        $this->db->prepare($query);
        $this->db->queryexecute();
    }

    public function verifyQueue(array $values) {
        $this->org_id = $values['org_id'];
        $this->code_authorize = $values['code_authorize'];
        $result = false;
        $check = $this->checkCode();
        if ($check):
            $sql = "UPDATE queue SET 
                status='in-location-waiting',
                authorize_timestamp = now()
                WHERE code_authorize='$this->code_authorize' AND org_id='$this->org_id'";
            $this->db->connect();
            $this->db->prepare($sql);
            $this->db->queryexecute();
            $result = true;
        endif;
        return $result;
    }

    private function generateQueno($orgid) {
        $queue = new Queue_Model();
        $lastNo = $queue->readLastOrganisationQueNo($orgid);
        return $lastNo + 1;
    }

}