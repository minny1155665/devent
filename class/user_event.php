<?php
class UserEvent{
    public $dbConnect;
    public $user_id;
    public $event_id;
    public $user_role;
    public $status;
    public $point;

    public $event_num;

    public function __construct(){
        $db = new Database();
        $this->dbConnect = $db->getConnection();
    }

    public function create(){
        $sql = "INSERT INTO user_event(user_id, event_id, status, user_role)
                VALUES (:user_id, :event_id, 'not_yet', :user_role)";
        $addUserEvent = $this->dbConnect->prepare($sql);
        $user_role = "hold";
        $addUserEvent->bindParam(":event_id", $this->event_id);
        $addUserEvent->bindParam(":user_id", $this->user_id);
        $addUserEvent->bindParam(":user_role", $this->user_role);
        $result = $addUserEvent->execute();
        return $result;
    }

    public function favorite(){
        $sql = "INSERT INTO user_event(user_id, event_id, user_role)
                VALUES (:user_id, :event_id, :user_role)";
        $addData = $this->dbConnect->prepare($sql);
        $this->user_role = "favorite";
        $addData->bindParam(":user_id", $this->user_id);
        $addData->bindParam(":event_id", $this->event_id);
        $addData->bindParam(":user_role", $this->user_role);
        $result = $addData->execute();
        return $result;
    }

    public function getFavorite(){
        $sql = "SELECT * FROM user_event 
                WHERE user_id = :user_id AND user_role = :user_role;";
        $getFav = $this->dbConnect->prepare($sql);
        $this->user_role = "favorite";
        $getFav->bindParam(":user_id", $this->user_id);
        $getFav->bindParam(":user_role", $this->user_role);
        $getFav->execute();
        $favEvent = $getFav->fetchAll(PDO::FETCH_ASSOC);
        return $favEvent;
    }

    public function getEventNum(){
        $sql = "SELECT COUNT(*) as num FROM user_event 
                WHERE user_id = :user_id AND (user_role = 'help' OR user_role = 'attend')";
        $getEventNum = $this->dbConnect->prepare($sql);
        $getEventNum->bindParam(":user_id", $this->user_id);
        $getEventNum->execute();
        $data = $getEventNum->fetch(PDO::FETCH_ASSOC);
        $this->event_num = $data["num"];
    }

    public function attend(){
        $sql = "INSERT INTO user_event(user_id, event_id, user_role, status)
                VALUES (:user_id, :event_id, :user_role, :status)";
        $this->status = "not_yet";
        $attendData = $this->dbConnect->prepare($sql);
        $attendData->bindParam(":user_id", $this->user_id);
        $attendData->bindParam(":event_id", $this->event_id);
        $attendData->bindParam(":user_role", $this->user_role);
        $attendData->bindParam(":status", $this->status);
        $result = $attendData->execute();
        return $result;
    }

    public function getTickets(){
        $sql = "SELECT * FROM user_event 
                WHERE user_id = :user_id AND (user_role = 'help' OR user_role = 'attend') AND status = 'not_yet'";
        $getTickets = $this->dbConnect->prepare($sql);
        $getTickets->bindParam(":user_id", $this->user_id);
        $getTickets->execute();
        $tickets = $getTickets->fetchAll(PDO::FETCH_ASSOC);
        return $tickets;
    }

    public function getPast(){
        $sql = "SELECT * FROM user_event 
                WHERE user_id = :user_id AND (user_role = 'help' OR user_role = 'attend') AND status = 'past'";
        $getPast = $this->dbConnect->prepare($sql);
        $getPast->bindParam(":user_id", $this->user_id);
        $getPast->execute();
        $past = $getPast->fetchAll(PDO::FETCH_ASSOC);
        return $past;
    }

    public function getHold(){
        $sql = "SELECT * FROM user_event 
        WHERE user_id = :user_id AND user_role = 'hold' AND status = 'not_yet'";
        $getHold = $this->dbConnect->prepare($sql);
        $getHold->bindParam(":user_id", $this->user_id);
        $getHold->execute();
        $hold = $getHold->fetchAll(PDO::FETCH_ASSOC);
        return $hold;
    }

    public function getHoldPast(){
        $sql = "SELECT * FROM user_event 
        WHERE user_id = :user_id AND user_role = 'hold' AND status = 'past'";
        $getHoldPast = $this->dbConnect->prepare($sql);
        $getHoldPast->bindParam(":user_id", $this->user_id);
        $getHoldPast->execute();
        $holdPast = $getHoldPast->fetchAll(PDO::FETCH_ASSOC);
        return $holdPast;
    }

    public function endStatus(){
        $sql = "UPDATE user_event SET status = 'past'
        WHERE event_id = :event_id";
        $setStatus = $this->dbConnect->prepare($sql);
        $setStatus->bindParam(":event_id", $this->event_id);
        $result = $setStatus->execute();
        return $result;
    }

    public function totalPoint(){
        $sql = "SELECT * FROM user_event WHERE event_id = :event_id";
        $pointData = $this->dbConnect->prepare($sql);
        $pointData->bindParam(":event_id", $this->event_id);
        $pointData->execute();
        $data = $pointData->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $event){
            $point[] = $event["point"];
        }

        return $point;

    //     $sql2 = "UPDATE user SET total_point = :total_point WHERE user_id = :user_id";
    //         $addPoint = $this->dbConnect->prepare($sql2);
    //         $addPoint->bindParam(":total_point", $total);
    //         $addPoint->bindParam(":user_id", $this->user_id);
    //         $result = $addPoint->execute();
            
    //     return $result;
    }
}
?>