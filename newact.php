<?php
include "./class/database.php";
include "./class/event.php";
include "./class/event_point.php";
$event = new Event();
$event_point = new EventPoint();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/basic.css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Comfortaa" />

	<link rel="stylesheet" type="text/css" href="css/newact.css">
 	<link rel="stylesheet" type="text/css" href="css/nav.css">
    <script type="text/javascript" src="scripts/returntop.js"></script>
	<title></title>
</head>
<body>
	<header class="toplogo">    	
		<h1 class="logo">
			<img src="image/logo1.png">
		</h1>
	</header>
	
	<form action="newact.php" method="post" enctype="multipart/form-data">
		<div class="newaparty">
	    	<div class="return"><h2>New a Event!</h2></div>
	    
	    	<div id="part1">
	    		活動照片
	        	<div class="uploadpic">
					<div id="cover">
						<label for="image"><img src="./image/plus.png" alt="新增圖片"></label>
						<input type="file" name="image" id="image">
					</div>
	        		<div id="side">
		        		<div></div>
		        		<div></div>
		        		<div></div>
		    		</div>
	    		</div>
	    		活動名稱
	    		<input type="text" placeholder="Name" name="name">
			</div>
		
	    	<div id="part2">
	   			活動日期:<br>
	   			<input type="date" name="date"><br>
	      		活動時間:<br>
	      		<input type="time" name="time"><br>
	        	活動地點:<br>
	        	<input type="text" placeholder="Location" name="location"><br>
	        	活動詳情
	        	<textarea name="content"></textarea>
			</div>
		
	    	<div id="part3">
	    		活動名額
	    		<!-- <input type="text" placeholder="min">
	    		~ -->
	    		<input type="number" placeholder="max" name="attendance">
	        	活動消耗點數
	        	<input type="number" placeholder="points" name="point">
	        	<!-- 點數發放方式
	    		<select>
	    			<option>每人均分</option>
	    			<option>前*位均分</option>
	    			<option>不發放</option>
	    		</select> -->
			</div>
		
	    	<div id="btn">
	    		<div class="laststep" onclick="location.href='index.php';">回首頁</div>
	    		<div class="nextstep"><input type="submit" name="submit" value="下一步"></div>
			</div>
		</div> 
	</form>

	<?php
		//檢查是否有按下送出按鈕
		if(isset($_POST["submit"])){
			$event_id = $event->randomId();
			$event->id = $event_id;
			$event->name = $_POST["name"];
			$event->date = $_POST["date"];
			$event->time = $_POST["time"];
			$event->location = $_POST["location"];
			$event->attendance = $_POST["attendance"];
			$event->content = $_POST["content"];
			$event_point->event_id = $event_id;
			$event_point->attend_point = $_POST["point"];
			//上傳圖片並移動到upload資料夾
			$type = array("image/jpg", "image/gif", "image/bmp", "image/jpeg", "image/png");
			$image_location = "./upload/"; 
			$image_name = $_FILES["image"]["name"];
			$image_temp = $_FILES["image"]["tmp_name"]; 
			$image_type = $_FILES["image"]["type"]; 
			$image = $image_location.$image_name;
			$event->image = $image;
			if(in_array(strtolower($image_type), $type)){
				if(isset($image_name) && !empty($image_name)){ 
					$result = move_uploaded_file($image_temp, $image);
				}
				if($event->create() && $event_point->createPoint() && $result === true){
					echo "<script>
							alert('新增成功');
							window.location.href='index.php';
						</script>";
				}else{
					echo '<div class="alert alert-secondary my-3" role="alert">新增失敗</div>';
				}
			}else{
				echo '<div class="alert alert-secondary my-3" role="alert">圖片格式錯誤</div>';
			}
		}
	?>

	<!-- <div class="navigation">
		<div id="main">
		    <div onclick="location.href='index.php';">首頁</div>
		    <div class="selectednav" onclick="location.href='newact.php';"><img src="image/logo/add.svg"></div>
		    <div  onclick="location.href='tickets.php';">票券</div>
		    <div onclick="location.href='personalpage.php';">個人</div>
		</div> 
	</div> -->
</body>
</html>