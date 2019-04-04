<?php

class Team_Model {

    private $table_name = "ost_team t";
    private $column_name = "team_id,lead_id,isenabled,noalerts,name,notes,created,updated";
    private $column_value = ":team_id,:lead_id,:isenabled,:noalerts,:name,:notes,:created,:updated";
    public $team_id;
    public $lead_id;
    public $isenabled;
    public $noalerts;
    public $name;
    public $notes;
    public $created;
    public $updated;

    public function __construct() {
        $this->db = new Mysql_Driver();
    }

    public function insert_setter() {
        $this->db->insertBind(':team_id', $this->team_id);
        $this->db->insertBind(':lead_id', $this->lead_id);
        $this->db->insertBind(':isenabled', $this->isenabled);
        $this->db->insertBind(':noalerts', $this->noalerts);
        $this->db->insertBind(':name', $this->name);
        $this->db->insertBind(':notes', $this->notes);
        $this->db->insertBind(':created', $this->created);
        $this->db->insertBind(':updated', $this->updated);
    }

    public function create_team() {
        $this->db->connect();
        $this->db->insertPrepare("INSERT INTO ost_team ($this->column_name) VALUES ($this->column_value)");
        $this->insert_setter();
        $this->db->insertExecute();
    }

    public function read_team() {
        $this->db->connect();
        $this->db->prepare("SELECT t.* FROM $this->table_name");
        $this->db->queryexecute();
        return $this->db->fetchOut('array');
    }

    public function read_team_byid() {
        $this->db->connect();
        $this->db->prepare("SELECT t.* FROM $this->table_name WHERE t.team_id='$this->team_id'");
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result[0];
    }

    public function delete_team_byid() {
        $this->db->connect();
        $this->db->prepare("DELETE FROM $this->table_name WHERE t.team_id='$this->team_id'");
        $this->db->queryexecute();
    }

}