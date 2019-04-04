<?php

class Staff_Model {

    private $table_name = "ost_staff s";
    private $column_name = "staff_id,group_id,dept_id,timezone_id,username,firstname,lastname,passwd,backend,email,phone,phone_ext,mobile,signature,notes,isactive,isadmin,isvisible,onvacation,assigned_only,show_assigned_tickets,daylight_saving,change_passwd,max_page_size,auto_refresh_rate,default_signature_type,default_paper_size,created,lastlogin,passwdreset,updated";
    private $column_value = ":staff_id,:group_id,:dept_id,:timezone_id,:username,:firstname,:lastname,:passwd,:backend,:email,:phone,:phone_ext,:mobile,:signature,:notes,:isactive,:isadmin,:isvisible,:onvacation,:assigned_only,:show_assigned_tickets,:daylight_saving,:change_passwd,:max_page_size,:auto_refresh_rate,:default_signature_type,:default_paper_size,:created,:lastlogin,:passwdreset,:updated";
    public $staff_id;
    public $group_id;
    public $dept_id;
    public $timezone_id;
    public $username;
    public $firstname;
    public $lastname;
    public $passwd;
    public $backend;
    public $email;
    public $phone;
    public $phone_ext;
    public $mobile;
    public $signature;
    public $notes;
    public $isactive;
    public $isadmin;
    public $isvisible;
    public $onvacation;
    public $assigned_only;
    public $show_assigned_tickets;
    public $daylight_saving;
    public $change_passwd;
    public $max_page_size;
    public $auto_refresh_rate;
    public $default_signature_type;
    public $default_paper_size;
    public $created;
    public $lastlogin;
    public $passwdreset;
    public $updated;

    public function __construct() {
        $this->db = new Mysql_Driver();
    }

    public function insert_setter() {
        $this->db->insertBind(':staff_id', $this->staff_id);
        $this->db->insertBind(':group_id', $this->group_id);
        $this->db->insertBind(':dept_id', $this->dept_id);
        $this->db->insertBind(':timezone_id', $this->timezone_id);
        $this->db->insertBind(':username', $this->username);
        $this->db->insertBind(':firstname', $this->firstname);
        $this->db->insertBind(':lastname', $this->lastname);
        $this->db->insertBind(':passwd', $this->passwd);
        $this->db->insertBind(':backend', $this->backend);
        $this->db->insertBind(':email', $this->email);
        $this->db->insertBind(':phone', $this->phone);
        $this->db->insertBind(':phone_ext', $this->phone_ext);
        $this->db->insertBind(':mobile', $this->mobile);
        $this->db->insertBind(':signature', $this->signature);
        $this->db->insertBind(':notes', $this->notes);
        $this->db->insertBind(':isactive', $this->isactive);
        $this->db->insertBind(':isadmin', $this->isadmin);
        $this->db->insertBind(':isvisible', $this->isvisible);
        $this->db->insertBind(':onvacation', $this->onvacation);
        $this->db->insertBind(':assigned_only', $this->assigned_only);
        $this->db->insertBind(':show_assigned_tickets', $this->show_assigned_tickets);
        $this->db->insertBind(':daylight_saving', $this->daylight_saving);
        $this->db->insertBind(':change_passwd', $this->change_passwd);
        $this->db->insertBind(':max_page_size', $this->max_page_size);
        $this->db->insertBind(':auto_refresh_rate', $this->auto_refresh_rate);
        $this->db->insertBind(':default_signature_type', $this->default_signature_type);
        $this->db->insertBind(':default_paper_size', $this->default_paper_size);
        $this->db->insertBind(':created', $this->created);
        $this->db->insertBind(':lastlogin', $this->lastlogin);
        $this->db->insertBind(':passwdreset', $this->passwdreset);
        $this->db->insertBind(':updated', $this->updated);
    }

    public function create_staff() {
        $this->db->connect();
        $this->db->insertPrepare("INSERT INTO ost_staff ($this->column_name) VALUES ($this->column_value)");
        $this->insert_setter();
        $this->db->insertExecute();
    }

    public function read_staff() {
        $this->db->connect();
        $this->db->prepare("SELECT s.* FROM $this->table_name");
        $this->db->queryexecute();
        return $this->db->fetchOut('array');
    }

    public function read_staff_byid() {
        $sql = "
            SELECT s.username as username,
            s.firstname as firstname,
            s.lastname as lastname,
            s.email as email,
            d.dept_name as deparment,
            g.group_name as group_name

            FROM $this->table_name
                LEFT JOIN ost_department d ON d.dept_id=s.dept_id
                LEFT JOIN ost_groups g ON g.group_id = s.group_id
            WHERE s.staff_id='$this->staff_id'
            ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result[0];
    }

    public function readStaffByName(){
        $sql = "SELECT s.* FROM $this->table_name WHERE s.username='$this->username'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return ($result) ? $result[0] : false;
    }

    public function readStaffMembers($availableonly=false){
        $sql="SELECT CONCAT('s-',s.staff_id) as staffid, CONCAT_WS(' ', s.firstname, s.lastname) as name
              FROM $this->table_name  ";

        if($availableonly) {
            $sql.=' INNER JOIN '.GROUP_TABLE.' g ON(g.group_id=s.group_id AND g.group_enabled=1) 
                   WHERE s.isactive=1 AND s.onvacation=0';
        }

        $sql.='  ORDER BY s.firstname, s.lastname';

        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return ($result) ? $result : false;
    }

    public function readAvailableTeam($availableOnly=false){
        $sql="SELECT CONCAT('t-',team_id) as team_id, name FROM ost_team ";
        if($availableOnly) {
            $sql='SELECT CONCAT("t-",t.team_id) as team_id, t.name, count(m.staff_id) as members '
                .' FROM ost_team t '
                .' LEFT JOIN ost_team_member m ON(m.team_id=t.team_id) '
                .' INNER JOIN ost_staff s ON(s.staff_id=m.staff_id AND s.isactive=1 AND onvacation=0) '
                .' INNER JOIN ost_groups g ON(g.group_id=s.group_id AND g.group_enabled=1) '
                .' WHERE t.isenabled=1 '
                .' GROUP BY t.team_id '
                .' HAVING members>0'
                .' ORDER by t.name ';
        }
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return ($result) ? $result : false;
    }

    public function delete_staff_byid() {
        $this->db->connect();
        $this->db->prepare("DELETE FROM $this->table_name WHERE s.staff_id='$this->staff_id'");
        $this->db->queryexecute();
    }

}

?>