<?php
session_start();
include "./class/database.php";
include "./class/user.php";
include "./class/user_event.php";
$user = new User();
$user->getUser();
$user_event = new UserEvent();
$user_event->user_id = $_SESSION["user_id"];
$user_event->getEventNum();
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" type="text/css" href="css/basic.css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Comfortaa" />
    <link rel="stylesheet" type="text/css" href="css/personalpage.css">
    <link rel="stylesheet" type="text/css" href="css/nav.css">
	<title>Document</title>
</head>
<body>
	<div id="app">
		<div id="personalpc"></div>
		<h2><?= $user->username?></h2>
		<div id="pointsarea">
			<div>
				點數:<br>
				<h2><?= $user->total_point?> pts</h2>
			</div>
			<div>
				參加活動數:<br>
				<h2><?= $user_event->event_num?> 場</h2>
			</div>
		</div>
		<ul>
            <li>編輯個人檔案</li>
            <li onclick="location.href='holder.php';">我主辦的活動</li>
			<li onclick="location.href='favoriteEvent.php';">收藏活動</li>
			<li onclick="location.href='logout.php';">登出</li>
			<!-- <li>設定</li> -->
		</ul>
	</div>
	<div class="navigation">
            <div id="main">
                <div onclick="location.href='index.php';">首頁</div>
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
</body>
</html>