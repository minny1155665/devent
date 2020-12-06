<?php
session_start();
include "./class/database.php";
include "./class/event.php";
include "./class/event_point.php";
include "./class/user_event.php";
$event = new Event();
$event_point = new EventPoint();
$user_event = new UserEvent();
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
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script src="scripts/jquery.js"></script>
	<title></title>
</head>
<!-- <script>
	$(document).ready(function(){
		$("#cover").live('click',function(){
			$("#image-upload").click();
		});
	});
</script> -->
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
					<label for="image-upload"  id="cover">
						<input type="file" name="image" id="image-upload">
					</label>					
	    		</div>
				</br>
	    		活動名稱
				<input type="text" placeholder="Name" name="name">
				<!-- 活動類別
      			<select>
       				<option>愛心公益</option>
       				<option>技能交換</option>
       				<option>揪團</option>
       				<option>其他</option>
      			</select> -->
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
				協辦名額
	    		<input type="number" placeholder="max" name="help">
	    		參加名額
	    		<input type="number" placeholder="max" name="attend">
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
			<div id="space"></div>
		</div> 
	</form>

	<?php
		//檢查是否有按下送出按鈕
		if(isset($_POST["submit"])){
			$event_id = $event->randomId();
			$event->id = $event_id;
			$event->name = $_POST["name"];
			$event->holder = $_SESSION["user_id"];
			$event->date = $_POST["date"];
			$event->time = $_POST["time"];
			$event->location = $_POST["location"];
			$event->help = $_POST["help"];
			$event->attend = $_POST["attend"];
			$event->content = $_POST["content"];
			$event_point->event_id = $event_id;
			$event_point->attend_point = $_POST["point"];
			$user_event->event_id = $event_id;
			$user_event->user_id = $_SESSION["user_id"];
			$user_event->user_role = "hold";
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
				if($event->create() && $event_point->create() && $user_event->create() && $result === true){
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
</body>
</html>