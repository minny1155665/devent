<?php
session_start();
include "./class/database.php";
include "./class/event.php";
include "./class/user_event.php";

$user_event = new UserEvent();
$events = new Event();
$user_event->user_id = $_SESSION["user_id"];
$userFavorite = $user_event->getFavorite();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/basic.css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Comfortaa" />
    <link rel="stylesheet" href="css/ticketpage.css">
    <link rel="stylesheet" href="css/nav.css">
</head>
<body>
	<header class="toplogo">    	
		<h1 class="logo">
			<img src="image/logo1.png">
		</h1>
	</header>
	<div id="app">
		<article>
            <h1>Favorite</h1>
                <?php if(!empty($userFavorite)):?>
                    <?php foreach($userFavorite as $fav):
                        $eventsData = $events->getTheEvents($fav["event_id"]);?>
                        <?php foreach($eventsData as $event):?>
                            <div id="tickets">
                                <div class="ticket">
                                    <div id="photo"><img src="<?= $event["image"]?>"></div>
                                    <div id="inform">
                                        <a id="time" href=""><?= $event["date"]?>   <?= $event["time"]?></a>
                                        <a id="location" href="https://www.google.com.tw/maps/search/<?= $event["location"]?>"><?= $event["location"]?></a>
                                        <p id="name"><?= $event["name"]?></p>
                                    </div>
                                </div>
                            </div>  
                        <?php endforeach;?>
                    <?php endforeach;?>
                <?php else:?>
                    </br>
                    <h1>尚未收藏活動</h1>
                <?php endif;?>
		</article>
		
		<div class="navigation">
            <div id="main">
                <div class="selectednav" onclick="location.href='index.php';">首頁</div>
                <div onclick="location.href='<?php
                    if(!isset($_SESSION["user_id"])){
                        echo "login.php";
                    }else{
                        echo "newact.php";
                    }
                ?>';"><img src="image/logo/add.svg"></div>
                <div onclick="location.href='<?php
                    if(!isset($_SESSION["user_id"])){
                        echo "login.php";
                    }else{
                        echo "tickets.php";
                    }
                ?>';">票券</div>
                <div onclick="location.href='<?php
                    if(!isset($_SESSION["user_id"])){
                        echo "login.php";
                    }else{
                        echo "personalpage.php";
                    }
                ?>';">個人</div>
                
                
            </div> 
        </div>

	</div>
</body>
</html>