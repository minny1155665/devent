<?php
    class Event{
        public $dbConnect;
        public $id;
        public $name;
        public $holder;
        public $date;
        public $time;
        public $location;
        public $help;
        public $attend;
        public $image;
        public $content;

        public function __construct(){
            $db = new Database();
            $this->dbConnect = $db->getConnection();
        }

        public function getAllEvents(){
            $sql = "SELECT * FROM events ORDER BY date DESC";
            $getData = $this->dbConnect->prepare($sql);
            $getData->execute();
            $data = $getData->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }

        public function getTheEvents($id){
            $sql = "SELECT * FROM events WHERE id = :id";
            $getData = $this->dbConnect->prepare($sql);
            $getData->bindParam(":id", $id);
            $getData->execute();
            $data = $getData->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }

        public function getOneEvent(){
            $sql = "SELECT * FROM events WHERE id = :id";
            $getOne = $this->dbConnect->prepare($sql);
            $getOne->bindParam(":id", $this->id);
            $getOne->execute();
            $data = $getOne->fetch(PDO::FETCH_ASSOC);
            $this->name = $data["name"];
            $this->holder = $data["holder"];
            $this->date = $data["date"];
            $this->time = $data["time"];
            $this->location = $data["location"];
            $this->help = $data["help"];
            $this->attend = $data["attend"];
            $this->image = $data["image"];
            $this->content = $data["content"];
        }

        public function randomId($length = 10) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        public function create(){
            $sql = "INSERT INTO events(id, name, holder, date, time, location, attend, help, image, content) 
                    VALUES (:id, :name, :holder, :date, :time, :location, :attend, :help, :image, :content)";
            $addData = $this->dbConnect->prepare($sql);
            $addData->bindParam(":id", $this->id);
            $addData->bindParam(":name", $this->name);
            $addData->bindParam(":holder", $this->holder);
            $addData->bindParam(":date", $this->date);
            $addData->bindParam(":time", $this->time);
            $addData->bindParam(":location", $this->location);
            $addData->bindParam(":attend", $this->attend);
            $addData->bindParam(":help", $this->help);
            $addData->bindParam(":image", $this->image);
            $addData->bindParam(":content", $this->content);
            $result = $addData->execute();
            return $result;
        }

        public function edit(){
            $sql = "UPDATE events 
                    SET name = :name, date = :date, time = :time, location = :location, attend = :attend, help = :help, content = :content
                    WHERE id = :id";
            $updateData = $this->dbConnect->prepare($sql);
            $updateData->bindParam(":name", $this->name);
            $updateData->bindParam(":date", $this->date);
            $updateData->bindParam(":time", $this->time);
            $updateData->bindParam(":location", $this->location);
            $updateData->bindParam(":attend", $this->attend);
            $updateData->bindParam(":help", $this->help);        
            $updateData->bindParam(":content", $this->content);
            $updateData->bindParam(":id", $this->id);
            $result = $updateData->execute();
            return $result;
        }

        public function editImage(){
            $sql = "UPDATE events SET image = :image WHERE id = :id";
            $updateImage = $this->dbConnect->prepare($sql);
            $updateImage->bindParam(":image", $this->image);
            $updateImage->bindParam(":id", $this->id);
            $result = $updateImage->execute();
            return $result;
        }

        public function delete(){
            $sql3 = "DELETE FROM user_event WHERE event_id = :id";
            $deleteUserEvent = $this->dbConnect->prepare($sql3);
            $deleteUserEvent->bindParam(":id", $this->id);
            $deleteUserEvent->execute();

            $sql4 = "DELETE FROM event_point WHERE event_id = :id";
            $deleteEventPoint = $this->dbConnect->prepare($sql4);
            $deleteEventPoint->bindParam(":id", $this->id);
            $deleteEventPoint->execute();

            $sql = "DELETE FROM events WHERE id = :id";
            $deleteData = $this->dbConnect->prepare($sql);
            $deleteData->bindParam(":id", $this->id);
            $result = $deleteData->execute();
            return $result;
        }
    }
?>