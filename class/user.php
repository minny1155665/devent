<?php
class User{
    public $dbConnect;
    public $user_id;
    public $username;
    public $password;
    public $total_point;

    public function __construct(){
        $db = new Database();
        $this->dbConnect = $db->getConnection();
    }

    public function create(){
        $sql = "INSERT INTO user(user_id, username, password)
                VALUES (:user_id, :username, :password)";
        $addData = $this->dbConnect->prepare($sql);
        $addData->bindParam(":user_id", $this->user_id);
        $addData->bindParam(":username", $this->username);
        $addData->bindParam(":password", $this->password);
        $result = $addData->execute();
        return $result;
    }

    public function login(){
        $sql = "SELECT COUNT(*) as amount FROM user WHERE user_id = :user_id AND password = :password";
        $userData = $this->dbConnect->prepare($sql);
        $userData->bindParam(":user_id", $this->user_id);
        $userData->bindParam(":password", $this->password);
        $userData->execute();
        $data = $userData->fetch(PDO::FETCH_ASSOC);
        
        return $data["amount"];
    }

    public function getUser(){
        $sql = "SELECT * FROM user WHERE user_id = :user_id";
        $getOne = $this->dbConnect->prepare($sql);
        $getOne->bindParam(":user_id", $_SESSION["user_id"]);
        $getOne->execute();
        $data = $getOne->fetch(PDO::FETCH_ASSOC);
        $this->username = $data["username"];
        $this->total_point = $data["total_point"];
    }

    // public function addPoint(){
    //     $sql = "UPDATE user SET total_point = :total_point";
    //     $pointData = $this->dbConnect->prepare($sql);
    //     $pointData->bindParam(":total_point", $this->total_point);
    //     $result = $pointData->execute();
    //     return $result;
    // }
}
?>