<?php
session_start();
include "./class/database.php";
include "./class/user_event.php";

$user_event = new UserEvent();
$user_event->user_id = $_SESSION["user_id"];
$user_event->event_id = $_GET["id"];

if($user_event->favorite()){
    //導回首頁
    echo "<script>
            alert('成功加入收藏');
            window.location.href='index.php';
        </script>";
}else{
    header("Location:index.php");
}
?>