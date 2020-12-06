<?php
include "./class/database.php";
include "./class/event.php";
$event = new Event();
$event->id = $_GET["id"];
//執行刪除方法
if($event->delete()){
    //導回首頁
    echo "<script>
            alert('刪除成功');
            window.location.href='index.php';
        </script>";
}else{
    header("Location:index.php");
}
?>