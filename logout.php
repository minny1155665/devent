<?php
session_start();

unset($_SESSION['user_id']);
echo "<script>
		alert('已登出');
		window.location.href='index.php';
	</script>";
?>