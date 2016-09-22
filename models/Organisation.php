<?php

class Organisation_Model {

    public function __construct() {
        $this->db = new Mysql_Driver();
    }

    function getAllOrganisation() {
        $sql = "SELECT * FROM organisation";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return $this->db->fetchOut('array');
    }

    function getAllOrganisationWithQue() {
        $sql = "SELECT DISTINCT(o.id) AS organisation_id, o.*,
IF((SELECT (queue_no) FROM queue WHERE org_id=o.id ORDER BY TIMESTAMP DESC LIMIT 1) > 0 , (SELECT (queue_no) FROM queue WHERE org_id=o.id ORDER BY TIMESTAMP DESC LIMIT 1),0)AS queno
FROM organisation o
LEFT JOIN queue q ON q.org_id = o.id";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        return $this->db->fetchOut('array');
    }

    function getOrganisationInfo($org_id) {
        $sql = "SELECT *,
(SELECT queue_no FROM queue WHERE org_id=id ORDER BY TIMESTAMP DESC LIMIT 1) as queue
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

}