<?php

class Tickets_Model {

    private $table_name = "ost_ticket t";
    private $column_name = "ticket_id,number,user_id,user_email_id,status_id,dept_id,sla_id,topic_id,staff_id,team_id,email_id,flags,ip_address,source,isoverdue,isanswered,duedate,reopened,closed,lastmessage,lastresponse,created,updated,ticket_format,report_date,location_id,report_no";
    private $column_value = ":ticket_id,:number,:user_id,:user_email_id,:status_id,:dept_id,:sla_id,:topic_id,:staff_id,:team_id,:email_id,:flags,:ip_address,:source,:isoverdue,:isanswered,:duedate,:reopened,:closed,:lastmessage,:lastresponse,:created,:updated,:ticket_format,:report_date,:location_id,:report_no";
    public $ticket_id;
    public $number;
    public $user_id;
    public $user_email_id;
    public $status_id;
    public $dept_id;
    public $sla_id;
    public $topic_id;
    public $staff_id;
    public $team_id;
    public $email_id;
    public $flags;
    public $ip_address;
    public $source;
    public $isoverdue;
    public $isanswered;
    public $duedate;
    public $reopened;
    public $closed;
    public $lastmessage;
    public $lastresponse;
    public $created;
    public $updated;
    public $ticket_format;
    public $report_date;
    public $location_id;
    public $report_no;

    public function __construct() {
        $this->db = new Mysql_Driver();
    }

    public function insert_setter() {
        $this->db->insertBind(':ticket_id', $this->ticket_id);
        $this->db->insertBind(':number', $this->number);
        $this->db->insertBind(':user_id', $this->user_id);
        $this->db->insertBind(':user_email_id', $this->user_email_id);
        $this->db->insertBind(':status_id', $this->status_id);
        $this->db->insertBind(':dept_id', $this->dept_id);
        $this->db->insertBind(':sla_id', $this->sla_id);
        $this->db->insertBind(':topic_id', $this->topic_id);
        $this->db->insertBind(':staff_id', $this->staff_id);
        $this->db->insertBind(':team_id', $this->team_id);
        $this->db->insertBind(':email_id', $this->email_id);
        $this->db->insertBind(':flags', $this->flags);
        $this->db->insertBind(':ip_address', $this->ip_address);
        $this->db->insertBind(':source', $this->source);
        $this->db->insertBind(':isoverdue', $this->isoverdue);
        $this->db->insertBind(':isanswered', $this->isanswered);
        $this->db->insertBind(':duedate', $this->duedate);
        $this->db->insertBind(':reopened', $this->reopened);
        $this->db->insertBind(':closed', $this->closed);
        $this->db->insertBind(':lastmessage', $this->lastmessage);
        $this->db->insertBind(':lastresponse', $this->lastresponse);
        $this->db->insertBind(':created', $this->created);
        $this->db->insertBind(':updated', $this->updated);
        $this->db->insertBind(':ticket_format', $this->ticket_format);
        $this->db->insertBind(':report_date', $this->report_date);
        $this->db->insertBind(':location_id', $this->location_id);
        $this->db->insertBind(':report_no', $this->report_no);
    }

    public function create_ticket() {
        $this->db->connect();
        $this->db->insertPrepare("INSERT INTO ost_ticket ($this->column_name) VALUES ($this->column_value)");
        $this->insert_setter();
        $this->db->insertExecute();
    }

    public function read_ticket() {
        $this->db->connect();
        $this->db->prepare("SELECT t.* FROM $this->table_name ");
        $this->db->queryexecute();
        return $this->db->fetchOut('array');
    }

    public function readTicketId(){
        $sql = "SELECT * FROM ost_ticket WHERE ticket_id='$this->ticket_id'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return (count($result)>0) ? $result[0]: false;
    }

    public function read_ticket_byid() {
        $sql = "SELECT t.ticket_id as ticket_id,
                t.number as ticket_number,
                c.subject as subject,
                s.name as status,
                p.priority_desc as priority,
                l.name as location,
                t.report_date as report_date,
                t.duedate as due_date,
                u.name as reported_by,
                i.value as severity,
                li.value as problem_type
               
                FROM $this->table_name
                    LEFT JOIN ost_ticket__cdata c ON c.ticket_id = t.ticket_id
                    LEFT JOIN ost_ticket_status s ON s.id = t.status_id
                    LEFT JOIN ost_ticket_priority p ON p.priority_id=c.priority
                    LEFT JOIN ost_organization_location l ON l.id=t.location_id
                    LEFT JOIN ost_user u ON u.id=t.user_id
                    LEFT JOIN ost_list_items i ON i.id = c.severity
                    LEFT JOIN ost_list_items li ON li.id = c.problemtype
                WHERE t.ticket_id='$this->ticket_id'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result[0];
    }

    public function readTicketQuery() {
        $sql = "SELECT t.ticket_id as ticket_id,
                t.number as ticket_number,
                c.subject as subject,
                s.name as status,
                p.priority_desc as priority,
                l.name as location,
                t.report_date as report_date,
                t.duedate as due_date,
                u.name as reported_by,
                i.value as severity,
                li.value as problem_type

                FROM $this->table_name
                    LEFT JOIN ost_ticket__cdata c ON c.ticket_id = t.ticket_id
                    LEFT JOIN ost_ticket_status s ON s.id = t.status_id
                    LEFT JOIN ost_ticket_priority p ON p.priority_id=c.priority
                    LEFT JOIN ost_organization_location l ON l.id=t.location_id
                    LEFT JOIN ost_user u ON u.id=t.user_id
                    LEFT JOIN ost_list_items i ON i.id = c.severity
                    LEFT JOIN ost_list_items li ON li.id = c.problemtype
                WHERE t.number LIKE '%$this->query% ' OR c.subject LIKE '%$this->query%'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }

    public function read_staff_ticket() {
        $sql = ("
            SELECT 'open' as status, count( ticket.ticket_id ) AS no_of_tickets
            FROM ost_ticket ticket INNER JOIN ost_ticket_status status ON (ticket.status_id=status.id AND status.state='open')
            WHERE ticket.isanswered = 0 AND
            ( (ticket.staff_id=1 AND status.state='open')
            OR ( ticket.team_id IN(9) AND status.state='open')
            OR ticket.dept_id IN(1,2,3,4,5,6,7) )
            UNION
            SELECT 'answered', count( ticket.ticket_id ) AS tickets
            FROM ost_ticket ticket
            INNER JOIN ost_ticket_status status ON (ticket.status_id=status.id AND status.state='open')
            WHERE ticket.isanswered = 1 AND ( (ticket.staff_id=1 AND status.state='open') OR ( ticket.team_id IN(9)
            AND status.state='open') OR ticket.dept_id IN(1,2,3,4,5,6,7) )
            UNION SELECT 'overdue', count( ticket.ticket_id ) AS tickets
            FROM ost_ticket ticket INNER JOIN ost_ticket_status status ON (ticket.status_id=status.id AND status.state='open')
            WHERE ticket.isoverdue =1 AND ( (ticket.staff_id=1 AND status.state='open') OR ( ticket.team_id IN(9)
            AND status.state='open') OR ticket.dept_id IN(1,2,3,4,5,6,7) )
            UNION SELECT 'assigned', count( ticket.ticket_id ) AS tickets
            FROM ost_ticket ticket INNER JOIN ost_ticket_status status ON (ticket.status_id=status.id AND status.state='open')
            WHERE ticket.staff_id = 1 AND ( (ticket.staff_id=1 AND status.state='open') OR ( ticket.team_id IN(9)
            AND status.state='open') OR ticket.dept_id IN(1,2,3,4,5,6,7) )
            UNION SELECT 'closed', count( ticket.ticket_id ) AS tickets
            FROM ost_ticket ticket INNER JOIN ost_ticket_status status ON (ticket.status_id=status.id AND status.state='closed' )
            WHERE 1 AND ( (ticket.staff_id=1 AND status.state='open') OR ( ticket.team_id IN(9) AND status.state='open')
            OR ticket.dept_id IN(1,2,3,4,5,6,7) )");
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }

    public function readOverDueTicket() {
        $sql = "
            SELECT ticket.ticket_id,tlock.lock_id,ticket.number,ticket.dept_id,ticket.staff_id,ticket.team_id,
            user.name ,email.address as email, dept.dept_name, status.state ,status.name as status,ticket.source,
            ticket.isoverdue,ticket.isanswered,ticket.created ,
            IF(ticket.duedate IS NULL,IF(sla.id IS NULL, NULL, DATE_ADD(ticket.created, INTERVAL sla.grace_period HOUR)), ticket.duedate) as duedate ,
            CAST(GREATEST(IFNULL(ticket.lastmessage, 0),
            IFNULL(ticket.closed, 0), IFNULL(ticket.reopened, 0), ticket.created) as datetime) as effective_date ,ticket.created as ticket_created,
            CONCAT_WS(' ', staff.firstname, staff.lastname) as staff, team.name as team ,
                IF(staff.staff_id IS NULL,team.name,CONCAT_WS(' ', staff.lastname, staff.firstname)) as assigned ,
                IF(ptopic.topic_pid IS NULL, topic.topic, CONCAT_WS(' / ', ptopic.topic, topic.topic)) as helptopic ,
                cdata.priority as priority_id, cdata.subject, pri.priority_desc, pri.priority_color, item.value AS severity
                FROM ost_ticket ticket
                LEFT JOIN ost_ticket_status status ON (status.id = ticket.status_id)
                LEFT JOIN ost_user user ON user.id = ticket.user_id
                LEFT JOIN ost_user_email email ON user.id = email.user_id
                LEFT JOIN ost_department dept ON ticket.dept_id=dept.dept_id
                LEFT JOIN ost_ticket_lock tlock ON (ticket.ticket_id=tlock.ticket_id AND tlock.expire>NOW() AND tlock.staff_id!=$this->staff_id)
                LEFT JOIN ost_staff staff ON (ticket.staff_id=staff.staff_id)
                LEFT JOIN ost_team team ON (ticket.team_id=team.team_id)
                LEFT JOIN ost_sla sla ON (ticket.sla_id=sla.id AND sla.isactive=1)
                LEFT JOIN ost_help_topic topic ON (ticket.topic_id=topic.topic_id)
                LEFT JOIN ost_help_topic ptopic ON (ptopic.topic_id=topic.topic_pid)
                LEFT JOIN ost_ticket__cdata cdata ON (cdata.ticket_id = ticket.ticket_id)
                LEFT JOIN ost_ticket_priority pri ON (pri.priority_id = cdata.priority)
                LEFT JOIN ost_list_items item ON (item.id = cdata.severity)
                WHERE ( ( ticket.staff_id=$this->staff_id AND status.state='open')
                OR ticket.dept_id IN (1,2,3,4,5,6,7)
                OR (ticket.team_id IN (9) AND status.state='open') ) AND status.state IN ( 'open' ) AND ticket.isoverdue=1
                ORDER BY pri.priority_urgency ASC, ISNULL(ticket.duedate) ASC, ticket.duedate ASC, effective_date ASC, ticket.created DESC";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }

    public function readOpenTicket() {
        $sql = "SELECT ticket.ticket_id,tlock.lock_id,ticket.`number`,ticket.dept_id,ticket.staff_id,ticket.team_id ,
		l.name as location, u.name as report_by, pt.value as problem_type, c.priority as priority,
				
                user.name ,email.address as email, dept.dept_name, status.state ,status.name as status,ticket.source,
                ticket.isoverdue,ticket.isanswered,ticket.created ,IF(ticket.duedate IS NULL,IF(sla.id IS NULL, NULL,
                DATE_ADD(ticket.created, INTERVAL sla.grace_period HOUR)), ticket.duedate) as duedate ,
                CAST(GREATEST(IFNULL(ticket.lastmessage, 0), IFNULL(ticket.closed, 0),
                IFNULL(ticket.reopened, 0), ticket.created) as datetime) as effective_date ,ticket.created as ticket_created,
                CONCAT_WS(' ', staff.firstname, staff.lastname) as staff, team.name as team ,IF(staff.staff_id IS NULL,team.name,
                CONCAT_WS(' ', staff.lastname, staff.firstname)) as assigned ,IF(ptopic.topic_pid IS NULL, topic.topic,
                CONCAT_WS(' / ', ptopic.topic, topic.topic)) as helptopic ,cdata.priority as priority_id,
                cdata.subject, pri.priority_desc, pri.priority_color, item.value AS severity
                FROM ost_ticket ticket LEFT JOIN ost_ticket_status status ON (status.id = ticket.status_id)
                LEFT JOIN ost_user user ON user.id = ticket.user_id LEFT JOIN ost_user_email email ON user.id = email.user_id
                LEFT JOIN ost_department dept ON ticket.dept_id=dept.dept_id
                LEFT JOIN ost_ticket_lock tlock ON (ticket.ticket_id=tlock.ticket_id AND tlock.expire>NOW() AND tlock.staff_id!= $this->staff_id)
                LEFT JOIN ost_staff staff ON (ticket.staff_id=staff.staff_id) LEFT JOIN ost_team team ON (ticket.team_id=team.team_id)
                LEFT JOIN ost_sla sla ON (ticket.sla_id=sla.id AND sla.isactive=1) LEFT JOIN ost_help_topic topic ON (ticket.topic_id=topic.topic_id)
                LEFT JOIN ost_help_topic ptopic ON (ptopic.topic_id=topic.topic_pid)
                LEFT JOIN ost_ticket__cdata cdata ON (cdata.ticket_id = ticket.ticket_id)
                LEFT JOIN ost_ticket_priority pri ON (pri.priority_id = cdata.priority)
		LEFT JOIN ost_organization_location l ON ticket.location_id=l.id
		LEFT JOIN ost_staff s ON ticket.staff_id = s.staff_id
		LEFT JOIN ost_ticket__cdata c ON ticket.ticket_id = c.ticket_id
		LEFT JOIN ost_user u ON u.id = ticket.user_id
		LEFT JOIN ost_list_items item ON (item.id = cdata.severity)
                LEFT JOIN ost_list_items pt ON (pt.id = cdata.problemtype)
				
		WHERE ( ( ticket.staff_id=$this->staff_id AND status.state='open')
                OR ticket.dept_id IN (1,2,3,4,5,6,7) OR (ticket.team_id IN (9) AND status.state='open') )
                AND status.state IN ( 'open' ) AND ticket.isanswered=0 ORDER BY pri.priority_urgency ASC, effective_date DESC, ticket.created DESC";
  
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }

    public function readAnsweredTicket() {
        $sql = '
            SELECT ticket.ticket_id,tlock.lock_id,ticket.`number`,ticket.dept_id,ticket.staff_id,
            ticket.team_id ,user.name ,email.address as email, dept.dept_name,
            status.state ,status.name as status,ticket.source,ticket.isoverdue,
            ticket.isanswered,ticket.created ,IF(ticket.duedate IS NULL,IF(sla.id IS NULL, NULL,
            DATE_ADD(ticket.created, INTERVAL sla.grace_period HOUR)), ticket.duedate) as duedate ,
            CAST(GREATEST(IFNULL(ticket.lastmessage, 0), IFNULL(ticket.closed, 0), IFNULL(ticket.reopened, 0),
            ticket.created) as datetime) as effective_date ,ticket.created as ticket_created,
            CONCAT_WS(" ", staff.firstname, staff.lastname) as staff, team.name as team ,
            IF(staff.staff_id IS NULL,team.name,CONCAT_WS(" ", staff.lastname, staff.firstname)) as assigned ,
            IF(ptopic.topic_pid IS NULL, topic.topic, CONCAT_WS(" / ", ptopic.topic, topic.topic)) as helptopic ,
            cdata.priority as priority_id, cdata.subject, pri.priority_desc, pri.priority_color, item.value AS severity
            FROM ost_ticket ticket
            LEFT JOIN ost_ticket_status status ON (status.id = ticket.status_id)
            LEFT JOIN ost_user user ON user.id = ticket.user_id
            LEFT JOIN ost_user_email email ON user.id = email.user_id
            LEFT JOIN ost_department dept ON ticket.dept_id=dept.dept_id
            LEFT JOIN ost_ticket_lock tlock ON (ticket.ticket_id=tlock.ticket_id AND tlock.expire>NOW() AND tlock.staff_id!='.$this->staff_id.')
            LEFT JOIN ost_staff staff ON (ticket.staff_id=staff.staff_id)
            LEFT JOIN ost_team team ON (ticket.team_id=team.team_id)
            LEFT JOIN ost_sla sla ON (ticket.sla_id=sla.id AND sla.isactive=1)
            LEFT JOIN ost_help_topic topic ON (ticket.topic_id=topic.topic_id)
            LEFT JOIN ost_help_topic ptopic ON (ptopic.topic_id=topic.topic_pid)
            LEFT JOIN ost_ticket__cdata cdata ON (cdata.ticket_id = ticket.ticket_id)
            LEFT JOIN ost_ticket_priority pri ON (pri.priority_id = cdata.priority)
            LEFT JOIN ost_list_items item ON (item.id = cdata.severity)
            WHERE ( ( ticket.staff_id='.$this->staff_id.' AND status.state="open") OR ticket.dept_id IN (1,2,3,4,5,6,7)
                OR (ticket.team_id IN (9) AND status.state="open") )
                AND status.state IN ( "open" )
                AND ticket.isanswered=1
            ORDER BY ticket.lastresponse DESC, ticket.created DESC';
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }

    public function readAssignedTicket() {
        $sql = '
            SELECT ticket.ticket_id,tlock.lock_id,ticket.`number`,ticket.dept_id,ticket.staff_id,
            ticket.team_id ,user.name ,email.address as email, dept.dept_name, status.state ,status.name as status,
            ticket.source,ticket.isoverdue,ticket.isanswered,ticket.created ,IF(ticket.duedate IS NULL,IF(sla.id IS NULL, NULL,
            DATE_ADD(ticket.created, INTERVAL sla.grace_period HOUR)), ticket.duedate) as duedate ,CAST(GREATEST(IFNULL(ticket.lastmessage, 0),
            IFNULL(ticket.closed, 0), IFNULL(ticket.reopened, 0), ticket.created) as datetime) as effective_date ,
            ticket.created as ticket_created, CONCAT_WS(" ", staff.firstname, staff.lastname) as staff, team.name as team ,
            IF(staff.staff_id IS NULL,team.name,CONCAT_WS(" ", staff.lastname, staff.firstname)) as assigned ,
            IF(ptopic.topic_pid IS NULL, topic.topic, CONCAT_WS(" / ", ptopic.topic, topic.topic)) as helptopic ,
            cdata.priority as priority_id, cdata.subject, pri.priority_desc, pri.priority_color, item.value AS severity
            FROM ost_ticket ticket
            LEFT JOIN ost_ticket_status status ON (status.id = ticket.status_id)
            LEFT JOIN ost_user user ON user.id = ticket.user_id LEFT JOIN ost_user_email email ON user.id = email.user_id
            LEFT JOIN ost_department dept ON ticket.dept_id=dept.dept_id
            LEFT JOIN ost_ticket_lock tlock ON (ticket.ticket_id=tlock.ticket_id AND tlock.expire>NOW() AND tlock.staff_id!='.$this->staff_id.')
            LEFT JOIN ost_staff staff ON (ticket.staff_id=staff.staff_id)
            LEFT JOIN ost_team team ON (ticket.team_id=team.team_id) LEFT JOIN ost_sla sla ON (ticket.sla_id=sla.id AND sla.isactive=1)
            LEFT JOIN ost_help_topic topic ON (ticket.topic_id=topic.topic_id)
            LEFT JOIN ost_help_topic ptopic ON (ptopic.topic_id=topic.topic_pid)
            LEFT JOIN ost_ticket__cdata cdata ON (cdata.ticket_id = ticket.ticket_id)
            LEFT JOIN ost_ticket_priority pri ON (pri.priority_id = cdata.priority)
            LEFT JOIN ost_list_items item ON (item.id = cdata.severity)
            WHERE ( ( ticket.staff_id='.$this->staff_id.' AND status.state="open")
                OR ticket.dept_id IN (1,2,3,4,5,6,7) OR (ticket.team_id IN (9) AND status.state="open") )
                AND status.state IN ( "open" ) AND ticket.staff_id=1
            ORDER BY pri.priority_urgency ASC, effective_date DESC, ticket.created DESC';
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }

    public function readClosedTicket() {
        $sql = '
            SELECT ticket.ticket_id,tlock.lock_id,ticket.`number`,ticket.dept_id,ticket.staff_id,ticket.team_id ,
            user.name ,email.address as email, dept.dept_name, status.state ,status.name as status,
            ticket.source,ticket.isoverdue,ticket.isanswered,ticket.created ,
            IF(ticket.duedate IS NULL,IF(sla.id IS NULL, NULL, DATE_ADD(ticket.created,
            INTERVAL sla.grace_period HOUR)), ticket.duedate) as duedate ,
            CAST(GREATEST(IFNULL(ticket.lastmessage, 0), IFNULL(ticket.closed, 0), IFNULL(ticket.reopened, 0),
            ticket.created) as datetime) as effective_date ,ticket.created as ticket_created,
            CONCAT_WS(" ", staff.firstname, staff.lastname) as staff, team.name as team ,
            IF(staff.staff_id IS NULL,team.name,CONCAT_WS(" ", staff.lastname,
            staff.firstname)) as assigned ,IF(ptopic.topic_pid IS NULL, topic.topic,
            CONCAT_WS(" / ", ptopic.topic, topic.topic)) as helptopic ,cdata.priority as priority_id,
            cdata.subject, pri.priority_desc, pri.priority_color, item.value AS severity
            FROM ost_ticket ticket
            LEFT JOIN ost_ticket_status status ON (status.id = ticket.status_id)
            LEFT JOIN ost_user user ON user.id = ticket.user_id
            LEFT JOIN ost_user_email email ON user.id = email.user_id
            LEFT JOIN ost_department dept ON ticket.dept_id=dept.dept_id
            LEFT JOIN ost_ticket_lock tlock ON (ticket.ticket_id=tlock.ticket_id AND tlock.expire>NOW() AND tlock.staff_id!='.$this->staff_id.')
            LEFT JOIN ost_staff staff ON (ticket.staff_id=staff.staff_id)
            LEFT JOIN ost_team team ON (ticket.team_id=team.team_id)
            LEFT JOIN ost_sla sla ON (ticket.sla_id=sla.id AND sla.isactive=1)
            LEFT JOIN ost_help_topic topic ON (ticket.topic_id=topic.topic_id)
            LEFT JOIN ost_help_topic ptopic ON (ptopic.topic_id=topic.topic_pid)
            LEFT JOIN ost_ticket__cdata cdata ON (cdata.ticket_id = ticket.ticket_id)
            LEFT JOIN ost_ticket_priority pri ON (pri.priority_id = cdata.priority)
            LEFT JOIN ost_list_items item ON (item.id = cdata.severity)
            WHERE ( ( ticket.staff_id='.$this->staff_id.' AND status.state="open") OR ticket.dept_id IN (1,2,3,4,5,6,7)
                OR (ticket.team_id IN (9) AND status.state="open") ) AND status.state IN ( "closed" )
                ORDER BY ticket.closed DESC, ticket.created DESC';
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
        $result = $this->db->fetchOut('array');
        return $result;
    }

    public function updateReassignTicket($ticket_id,$id,$type='staff'){
        $sql = "UPDATE ost_ticket SET ";
        if($type=='staff'):
            $sql .= " staff_id='$id' ";
            else:
            $sql .= " team_id='$id' ";
        endif;
        $sql .= "WHERE ticket_id='$ticket_id'";
        $this->db->connect();
        $this->db->prepare($sql);
        $this->db->queryexecute();
    }

    public function delete_ticket_byid() {
        $this->db->connect();
        $this->db->prepare("DELETE FROM $this->table_name WHERE t.ticket_id='$this->ticket_id' '");
        $this->db->queryexecute();
    }

}

?>