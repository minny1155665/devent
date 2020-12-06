<?php
session_start();
include "./class/database.php";
include "./class/user_event.php";
$user_event = new UserEvent();
$user_event->user_id = $_SESSION["user_id"];
$user_event->event_id = $_GET["id"];
$user_event->user_role = $_GET["sort"];

if($user_event->attend()){
    //導回首頁
    echo "<script>
            alert('報名成功');
            window.location.href='index.php';
        </script>";
}else{
    echo "<script>
            alert('報名失敗，請稍號再試');
            window.location.href='index.php';
        </script>";
}
?>