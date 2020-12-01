<?php
class EventPoint{
    public $dbConnect;
    public $event_id;
    public $hold_point;
    public $help_point;
    public $attend_point;

    public $help_amount;
    public $attend_amount;

    public function __construct(){
        $db = new Database();
        $this->dbConnect = $db->getConnection();
    }

    public function getAllEventPoint(){
        $sql = "SELECT * FROM event_point";
        $getData = $this->dbConnect->prepare($sql);
        $getData->execute();
        $data = $getData->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getOneEventPoint(){
        $sql = "SELECT * FROM event_point WHERE event_id = :event_id";
        $getOne = $this->dbConnect->prepare($sql);
        $getOne->bindParam(":event_id", $this->event_id);
        $getOne->execute();
        $data = $getOne->fetch(PDO::FETCH_ASSOC);
        $this->hold_point = $data["hold_point"];
        $this->help_point = $data["help_point"];
        $this->attend_point = $data["attend_point"];
    }

    public function createPoint(){
        $sql = "INSERT INTO event_point(event_id, attend_point)
                VALUES (:event_id, :attend_point)";
        $addData = $this->dbConnect->prepare($sql);
        $addData->bindParam(":event_id", $this->event_id);
        $addData->bindParam(":attend_point", $this->attend_point);
        $result = $addData->execute();
        return $result;
    }

    public function getHelpAmount(){ 
        $sql = "SELECT COUNT(*) as amount FROM list WHERE event_id = :event_id AND user_role = 'help'";
        $getHelp = $this->dbConnect->prepare($sql);
        $getHelp->bindParam(":event_id", $this->event_id);
        $getHelp->execute();
        $data = $getHelp->fetch(PDO::FETCH_ASSOC);
        $this->help_amount = $data["amount"];
    }

    public function getAttendAmount(){ 
        $sql = "SELECT COUNT(*)  as amount FROM list WHERE event_id = :event_id AND user_role = 'attend'";
        $getAttend = $this->dbConnect->prepare($sql);
        $getAttend->bindParam(":event_id", $this->event_id);
        $getAttend->execute();
        $data = $getAttend->fetch(PDO::FETCH_ASSOC);
        $this->attend_amount = $data["amount"];
    }

    public function calculate(){
        $sql = "SELECT * FROM event_point WHERE event_id = :event_id";
        $get = $this->dbConnect->prepare($sql);
        $get->bindParam(":event_id", $this->event_id);
        $get->execute();
        $data = $get->fetch(PDO::FETCH_ASSOC);
        $this->attend_point = $data["attend_point"];

        $total_point = $this->attend_point * $this->attend_amount;
        if($this->help_amount != 0){
            $this->hold_point = $total_point / ($this->help_amount + 1);
            $this->help_point = $total_point / ($this->help_amount + 1);
        }else{
            $this->hold_point = $total_point;
            $this->help_point = 0;
        }

        $sql_2 = "UPDATE event_point 
                  SET hold_point = :hold_point, help_point = :help_point 
                  WHERE event_id = :event_id";
        $updateData = $this->dbConnect->prepare($sql_2);
        $updateData->bindParam(":event_id", $this->event_id);
        $updateData->bindParam(":hold_point", $this->hold_point);
        $updateData->bindParam(":help_point", $this->help_point);
        $result = $updateData->execute();
        return $result;
    }
}
?>