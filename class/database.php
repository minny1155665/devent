<?php
class Database{
    //取得資料庫連線物件的方法
    public function getConnection(){
        $dbConnect = new PDO("mysql:host=localhost;port=3306;dbname=devent_db","root","");
        return $dbConnect;
    }
}
?>