<?php
class Ticketthread_Model {

    private $table_name = "ost_ticket_thread t";
    private $column_name = "id,pid,ticket_id,staff_id,user_id,thread_type,poster,source,title,body,format,ip_address,created,updated,status_id,deleted,report_date";
    private $column_value = ":id,:pid,:ticket_id,:staff_id,:user_id,:thread_type,:poster,:source,:title,:body,:format,:ip_address,:created,:updated,:status_id,:deleted,:report_date";
    public $id;
    public $pid;
    public $ticket_id;
    public $staff_id;
    public $user_id;
    public $thread_type;
    public $poster;
    public $source;
    public $title;
    public $body;
    public $format;
    public $ip_address;
    public $created;
    public $updated;
    public $status_id;
    public $deleted;
    public $report_date;

    public function __construct() {
        $this->db = new Mysql_Driver();
    }

    public function insert_setter() {
        $this->db->insertBind(':id', $this->id);
        $this->db->insertBind(':pid', $this->pid);
        $this->db->insertBind(':ticket_id', $this->ticket_id);
        $this->db->insertBind(':staff_id', $this->staff_id);
        $this->db->insertBind(':user_id', $this->user_id);
        $this->db->insertBind(':thread_type', $this->thread_type);
        $this->db->insertBind(':poster', $this->poster);
        $this->db->insertBind(':source', $this->source);
        $this->db->insertBind(':title', $this->title);
        $this->db->insertBind(':body', $this->body);
        $this->db->insertBind(':format', $this->format);
        $this->db->insertBind(':ip_address', $this->ip_address);
        $this->db->insertBind(':created', $this->created);
        $this->db->insertBind(':updated', $this->updated);
        $this->db->insertBind(':status_id', $this->status_id);
        $this->db->insertBind(':deleted', $this->deleted);
        $this->db->insertBind(':report_date', $this->report_date);
    }

    public function create_thread() {
	$sql = "INSERT INTO ost_ticket_thread ($this->column_name) VALUES ($this->column_value)";
        $this->db->connect();
        $this->db->insertPrepare($sql);
        $this->insert_setter();
        $this->db->insertExecute();
    }

    public function read_thread() {
        $this->db->connect();
        $this->db->prepare("SELECT t.* FROM $this->table_name");
        $this->db->queryexecute();
        return $this->db->fetchOut('array');
    }

    public function readThreadByTicketId() {
        $sql = "SELECT t.* FROM $this->table_name WHERE t.ticket_id='$this->ticket_id' ";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return (count($result)) ? $result : false;
    }

    public function read_thread_byid() {
        $this->db->connect();
        $this->db->prepare("SELECT t.* FROM $this->table_name WHERE t.id='$this->id' ");
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result[0];
    }


    public function getThreadEntries($type, $order='ASC') {
        if(!$order || !in_array($order, array('DESC','ASC')))
            $order='ASC';

        $sql="SELECT thread.*, COALESCE(user.name,
                    IF(staff.staff_id, CONCAT_WS(' ', staff.firstname, staff.lastname), NULL)) as name,
                    count(DISTINCT attach.attach_id) as attachments
                    FROM ost_ticket_thread thread
                    LEFT JOIN ost_user user
                    ON (thread.user_id=user.id)
                    LEFT JOIN ost_staff staff
                    ON (thread.staff_id=staff.staff_id)
                    LEFT JOIN ost_ticket_attachment attach
                    ON (thread.ticket_id=attach.ticket_id AND thread.id=attach.ref_id)
                    WHERE  thread.ticket_id='$this->ticket_id'";

        if($type && is_array($type)):
            $t = implode ("','", $type);
             $sql.=" AND thread.thread_type IN('$t')";
        elseif($type):
            $sql.=" AND thread.thread_type='$type'";
        endif;

        $sql.= " GROUP BY thread.id  ORDER BY thread.report_date $order";

        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');

        return (count($result)>0) ? $result : false;
    }



}