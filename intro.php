<?php
session_start();
if(!isset($_SESSION["login"])):
header("location:authorization.php");
else:
?>


<!doctype html>
<html>
<head>
	<meta charset = "utf-8">
	<title>Добро пожаловать!</title>
	<link href = "css/style.css" rel = "stylesheet">
</head>
<body>
	<div id = "welcome">
		<h2>Добро пожаловать, <span><?php echo $_SESSION['login'];?></span></h2>
		<p><a href = "logout.php">Выйти</a></p>
	</div>
</body>
</html>

<?php endif; ?>