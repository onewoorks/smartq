<?php

class Imigresen_Model {

    public function __construct() {
        $this->db = new Mysql_Driver();
    }

    function getAllOrganisation($type) {
        $sql = "SELECT * FROM imi_organisation";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return $this->db->fetchOut('array');
    }

    function getAllOrganisationWithQue() {
        $sql = "SELECT *, "
                . "(SELECT count(id) FROM queue WHERE DATE(timestamp)=DATE(now())) as total_queue "
                . "FROM imi_organisation";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return $this->db->fetchOut('array');
    }
    
    function getOrganisationInfoAdd($org_id){
        $sql = "UPDATE organisation SET que_no=(que_no+1) WHERE id=$org_id";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        
        $sql2 = "SELECT *, date_format(now() + interval (que_no-current_no)*10 minute,'%h:%i %p') as estimate FROM organisation WHERE id=$org_id";
        $this->db->connect();
        $this->db->prepare($sql2);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return ($result) ? $result[0] : false;
    }
    
    function getOrganisation($org_id){
        $sql = "SELECT * FROM imi_organisation WHERE id=$org_id";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return $this->db->fetchOut('array');
    }

    function getOrganisationInfo($org_id) {
        $sql = "SELECT *,
            (SELECT queue_no FROM queue WHERE org_id=id ORDER BY TIMESTAMP DESC LIMIT 1) as queue,
            date_format(now() + interval (que_no-current_no)*10 minute,'%h:%i %p') as estimate
            FROM organisation WHERE id=$org_id";
        
        $sqlQueue = "SELECT queue_no FROM queue WHERE org_id='$org_id' ORDER BY timestamp DESC LIMIT 1";

        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $org_info = $this->db->fetchOut('array');
        $result = ($org_info) ? $org_info[0] : false;

        if ($result):
            $this->db->prepare($sqlQueue);
            $this->db->queryexecute();
            $org_queue = $this->db->fetchOut('array');
            $org_info[0]['queue'] = ($org_queue) ? $org_queue[0]['queue_no'] : 0;
        endif;

        return ($result) ? $org_info[0] : false;
    }
    
    public function getAllOrganisationByDistance(){
        $sql = "SELECT * FROM organisation ORDER BY jarak ASC";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return $this->db->fetchOut('array');
    }
    
    public function getAllOrganisationByQueSort(){
        $sql = "SELECT * FROM organisation ORDER BY que_no ASC";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return $this->db->fetchOut('array');
    }
    
    public function getAllOrganisationByAlphaSort(){
        $sql = "SELECT * FROM organisation ORDER BY name ASC";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return $this->db->fetchOut('array');   
    }

}
