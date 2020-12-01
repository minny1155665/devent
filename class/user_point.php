<?php
class UserPoint{
    public $dbConnect;
    public $user_id;
    public $event_id;
    public $user_role;
    public $point;
    public $total_point;

    public function __construct(){
        $db = new Database();
        $this->dbConnect = $db->getConnection();
    }

    public function getUserPoint(){
        $sql = "SELECT * FROM user_point";
        //
        $getData = $this->dbConnect->prepare($sql);
        $getData->execute();
        $data = $getData->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function 
}
?>