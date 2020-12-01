<?php
include "./class/database.php";
include "./class/event.php";
include "./class/event_point.php";

$event = new Event();
$event->id = $_GET["id"];
$event->getOneEvent();

$event_point = new EventPoint();
$event_point->event_id = $_GET["id"];
$event_point->getOneEventPoint();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/more.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="scripts/eventmore.js"></script>
    <script type="text/javascript" src="scripts/returntop.js"></script>
	<title></title>
</head>
<body>

	<div id="hidebg">
	    <div id="eventcontent">
	        <div class="return"><a  href="javascript:history.back()"><img src="image/close.png"></a></div>
	        <div class="returntop"></div>
	        <img src="<?= $event->image?>">

	        <article>
	            <p id="name"><?= $event->name?></p>
				<p>發起人: <a id="holder" href=""><?= $event->holder?></a></p>
				<p>日期: <a id="date"><?= $event->date?></a></p>
	            <p>時間: <a id="time"><?= $event->time?></a></p>
	            <p>地點: <a id="location" href=""><?= $event->location?></a></p>
	            <p>消耗點數: <a id="point"><?= $event_point->attend_point?>pt</a></p>
	            <p>協辦點數發放規則:</p>
	            <p id="rule">一人500點。限10人。</p>
	            <p>詳情:</p>
	            <p id="more"><?= $event->content?></p>
	            <div id="numbers">目前參與人數: 6人</div>
	        </article>

	        <div class="buttons">
	            <div id="contact">聯絡</div>
	            <div id="attend">參加</div>
	            <div id="fun">有興趣</div>
	        </div>
	    </div>
	</div>

</body>
</html>