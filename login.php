<?php
session_start();
include "./class/database.php";
include "./class/user.php";
$user = new User();
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Time plus</title>
	<link rel="stylesheet" type="text/css" href="css/basic.css">
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Comfortaa" />
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
	<form action="login.php" method="post">
        <div id="app">
            <img src="image/logo2.png">
	    	<input type="text" name="user_id" placeholder="帳號">
	    	<input type="password" name="password" placeholder="密碼">
			<div class="login"><input type="submit" name="submit" value="登入"></div>
			<a href="">忘記密碼</a>
			<a href="./signup.php">註冊</a>
	    </div>
	</form>	
	
	<?php
		//檢查是否有按下送出按鈕
		if(isset($_POST["submit"])){
            $user->user_id = $_POST["user_id"];
            $user->password = $_POST["password"];
			
			if($user->user_id && $user->password){
				if($user->login() == 1){
					echo "<script>
							alert('登入成功');
							window.location.href='index.php';
						</script>";
					$_SESSION["user_id"] = $user->user_id;
				}elseif($user->login() < 1){
					echo "<script>
							alert('帳密錯誤');
							window.location.href='login.php';
						</script>";
				}
			}else{
				echo "<script>
							alert('欄位不得為空');
							window.location.href='login.php';
						</script>";
			}
            
        }
	?>
</body>
</html>