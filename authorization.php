<?php session_start();?>
<?php require_once("includes/connection.php");?>
<?php
	if(isset($_SESSION['login'])){
		header("Location: intro.php");
	}
	
	if(isset($_POST["submit"])) {
		if (!empty($_POST['login']) && !empty($_POST['password'])) {
			$login = $_POST['login'];
			$password = $_POST['password'];
			$query = "SELECT login, password	FROM users WHERE login = '$login'";	
			$sql = mysqli_query($link, $query) or die(mysqli_error());
			$row = mysqli_fetch_array($sql);
			$login_db = $row['login'];
			$password_db = $row['password'];

			if($login == $login_db) {
				if ($password == $password_db) {
					$_SESSION['login'] = $login;
					header("Location: intro.php");
				} else { $message = "Вы ввели неправильный пароль";}
			} else { $message = "Пользователь с таким логином не зарегистрирован";}
		} else {$message = "Введите логин и пароль";}
	}
?>
<!doctype html>
<html>
<head>
	<meta charset = "utf-8">
	<title>Авторизация</title>
	<link href = "css/style.css" rel = "stylesheet">
</head>
<body>
	<div class = "container mlogin">
		<div id = "lodin">
			<h1>Авторизация</h1>
			<form id = "loginforform"  name="authorization" 
			method = "POST">
				<p><label>Логин <input name = "login" type = "text" size = "20" value="<?php echo $login ?>"></label></p>
				<p><label>Пароль <input name = "password" type = "password" size = "20"></label></p>
				<p><input name = "submit" type = "submit" value = "Войти"></p>
				<p>Еще не зарегистрированы? <a href = "registration.php">Регистрация</a></p>
			</form>
		</div>
	</div>
</body>
</html>

<?php if (!empty($message)) {echo "<p class=\"error\">" . $message . "</p>";} ?>
