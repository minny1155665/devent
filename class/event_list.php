<?php
class EventList{
    public $dbConnect;
    public $list_id;
    public $event_id;
    public $user_id;
    public $user_role;

    // public $help_amount;
    // public $attend_amount;

    public function __construct(){
        $db = new Database();
        $this->dbConnect = $db->getConnection();
    }

    
}
?>