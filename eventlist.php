<?php 
session_start();
include "./class/database.php";
include "./class/event.php";
include "./class/user_event.php";
include "./class/event_point.php";

$events = new Event();
$eventData = $events->getAllEvents();
$user_event = new UserEvent();
$event_point = new EventPoint();
?>

<!DOCTYPE html>
<html lang="zh-tw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time plus</title>
    <link rel="stylesheet" type="text/css" href="css/basic.css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Comfortaa" />
    <link rel="stylesheet" href="css/homepage.css">
    <link rel="stylesheet" type="text/css" href="css/hmbanner.css">
    <link rel="stylesheet" type="text/css" href="css/nav.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="scripts/banner.js"></script>
    <script src="scripts/jquery.js"></script>
</head>
<body>  
	<div id='app'>
		<header class="toplogo">    	
			<h1 class="logo">
                <img src="image/logo1.png">
            </h1>
        </header>
        <div class="searchbar">
            <img src="image/search.png" alt="">
            <input type="text" id="txtSearch" onChange="txtSearch()" placeholder="搜尋">
        </div>
    	<div id="all">
            <div class="nav">
                <ul>
                    <li class="active">政大<br>藝術季</li>
                    <li>政大<br>包種茶</li>
                    <li>台北<br>蚤之市</li>
                    <li>貴人<br>散步</li>
                    <li>2020<br>ttf</li>
                </ul>
            </div>
            <div class="banner">
                <img src="./image/party1.jpg" alt="" />
                <img src="./image/party2.jpg" alt="" />
                <img src="./image/party3.jpg" alt="" />
                <img src="./image/party4.jpg" alt="" />
                <img src="./image/party5.jpg" alt="" />
            </div>
        </div>
        <div id="cattitle">分類：</div>
        <div class="selectcat">

            <a>
                <img src="image/cat1.png">
                愛心公益
            </a>
            <a>
                <img src="image/cat2.png">
                技能交換
            </a>
            <a>
                <img src="image/cat3.png">
                揪團
            </a>
            <a>
                <img src="image/cat4.png">
                其他
            </a>
        </div>
    	<article>
    		<header>
    			<h2>🔥活動列表</h2>

    			<div class="order">
    				<select>
    					<option>由新到舊</option>
    					<option>由舊到新</option>
    					<option>人氣優先</option>
    					<!-- <option>距離優先</option> -->
    				</select>
    			</div>
    		</header>
            <div class="helporattend">
                <div><button onclick="location.href='eventlist.php?sort=help'">協辦</button></div>
                <div><button onclick="location.href='eventlist.php?sort=attend'">參加</button></div>
            </div>
            <div id="eventlist">         
                <?php if($_GET["sort"] == "attend"):?>
                    <?php foreach($eventData as $event):?>
                        <?php $user_event->event_id = $event["id"];?>
                        <?php if($user_event->getStatus() == 'not_yet' && $event["attend"] > 0):?>
                            <div class="events">
                                <a id='imga'href="./eventmore.php?sort=<?=$_GET["sort"]?>&id=<?= $event["id"]?>">
                                    <div class="eventimg" id="coverpic"
                                    style="background-image: url('<?= $event["image"]?>');" ></div>
                                </a>
                                <div>
                                    <h3 id="name"><?= $event["name"]?></h3>
                                    <p id="time" href=""><?= $event["date"]?>   <?= $event["time"]?></p>
                                    <a id="location" href="https://www.google.com.tw/maps/search/<?= $event["location"]?>"><?= $event["location"]?></a><br>
                                    
                                </div>
                                <?php if(isset($_SESSION["user_id"])):?>
                                    <?php if($_SESSION["user_id"] != $event["holder"]):?>
                                        <div id="btnarea">
                                            <div id="interested" onclick="location.href='favorite.php?id=<?= $event["id"]?>';"></div>
                                            <div onclick="location.href='attend.php?sort=<?=$_GET["sort"]?>&id=<?=$event["id"]?>'">attend</div>
                                        </div>
                                    <?php else:?>
                                        <div id="btnarea">
                                            <div id="edit">編輯</div>
                                            <div id="delete" onclick="location.href='delete.php?id=<?= $event["id"]?>';">刪除</div>
                                        </div>
                                    <?php endif;?>
                                <?php else:?>
                                    <div id="btnarea">
                                    </div>
                                <?php endif;?>
                            </div>
                        <?php endif;?>
                    <?php endforeach;?>
                <?php elseif($_GET["sort"] == "help"):?>
                    <?php foreach($eventData as $event):?>
                        <?php $user_event->event_id = $event["id"];?>
                        <?php if($user_event->getStatus() == 'not_yet' && $event["help"] > 0):?>
                            <div class="events">
                                <a id='imga'href="./eventmore.php?sort=<?=$_GET["sort"]?>&id=<?= $event["id"]?>">
                                    <div class="eventimg" id="coverpic"
                                    style="background-image: url('<?= $event["image"]?>');" ></div>
                                </a>
                                <div>
                                    <h3 id="name"><?= $event["name"]?></h3>
                                    <p id="time" href=""><?= $event["date"]?>   <?= $event["time"]?></p>
                                    <a id="location" href="https://www.google.com.tw/maps/search/<?= $event["location"]?>"><?= $event["location"]?></a><br>
                                    
                                </div>
                                <?php if(isset($_SESSION["user_id"])):?>
                                    <?php if($_SESSION["user_id"] != $event["holder"]):?>
                                        <div id="btnarea">
                                            <div id="interested" onclick="location.href='favorite.php?id=<?= $event["id"]?>';"></div>
                                            <div onclick="location.href='attend.php?sort=<?=$_GET["sort"]?>&id=<?=$event["id"]?>'">attend</div>
                                        </div>
                                    <?php else:?>
                                        <div id="btnarea">
                                            <div id="edit">編輯</div>
                                            <div id="delete" onclick="location.href='delete.php?id=<?= $event["id"]?>';">刪除</div>
                                        </div>
                                    <?php endif;?>
                                <?php else:?>
                                    <div id="btnarea">
                                    </div>
                                <?php endif;?>
                            </div>
                        <?php endif;?>
                    <?php endforeach;?>
                <?php endif;?>
            </div>

        </article>

		<footer>
            <div>
    			 <a href="">隱私政策</a>
                 <a href="">使用條款</a>
                 <a href="">聯絡我們</a>
            </div>
		</footer>

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
