<?php
    include "./class/database.php";
    include "./class/event_point.php";
    include "./class/user_event.php";

    $event_point = new EventPoint();
    $user_event = new UserEvent();

    $event_point->event_id = $_GET["id"];
    $event_point->help_amount = $event_point->getHelpAmount();
    $event_point->attend_amount = $event_point->getAttendAmount();
    
    if($event_point->calculate() && $event_point->collectPoint() && $user_event->endStatus() && $user_event->totalPoint()){
        echo "<script>
                alert('活動結束，點數已分配完畢');
                window.location.href='holder.php';
            </script>";
    }else{
        header("Location:holder.php");
    }
?>