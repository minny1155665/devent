<?php
    include "./class/database.php";
    include "./class/event_point.php";
    include "./class/user_event.php";
    include "./class/user.php";

    $event_point = new EventPoint();
    $user_event = new UserEvent();
    $user = new User();

    $user_event->event_id = "XckyoF1rAD";
    $event_point->event_id = "XckyoF1rAD";
    $event_point->help_amount = $event_point->getHelpAmount();
    $event_point->attend_amount = $event_point->getAttendAmount();
    $user->total_point = $user_event->totalPoint();
    
    echo $event_point->help_amount."<br>";
    echo $event_point->attend_amount."<br>";
    echo $user_event->total_point."<br>";
    echo $user_event->getStatus();
    print_r($user_event->getStatus());
    
    
?>