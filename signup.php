<?php
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
    <form action="signup.php" method="post">
        <div id="app">
            <img src="image/logo2.png">
            <input type="text" name="username" placeholder="姓名">
	    	<input type="text" name="user_id" placeholder="帳號">
	    	<input type="password" name="password" placeholder="密碼">
	    	<div class="login"><input type="submit" name="submit" value="註冊"></div>
	    </div>
    </form>	

    <?php
		//檢查是否有按下送出按鈕
		if(isset($_POST["submit"])){
            $user->username = $_POST["username"];
            $user->user_id = $_POST["user_id"];
            $user->password = $_POST["password"];
            
            if($user->create()){
                echo "<script>
                        alert('註冊成功');
                        window.location.href='index.php';
                    </script>";
            }else{
                echo '<div class="alert alert-secondary my-3" role="alert">註冊失敗</div>';
            }
        }
	?>
</body>
</html>