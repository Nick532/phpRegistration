<?php session_start();?>
<?php require_once("includes/connection.php");
	if(isset($_SESSION['login'])){
		header("Location: intro.php");
	}
	
	if(isset($_POST["submit"])) {
		if (!empty($_POST['login']) && !empty($_POST['pass1']) && !empty($_POST['pass2'])) 	{

			$login=$_POST['login'];
			$pass1=$_POST['pass1'];
			$pass2=$_POST['pass2'];

			$query = mysqli_query($link, "SELECT * FROM users WHERE login = '$login' ");
			$numrows = mysqli_num_rows($query);

			if($numrows == 0) {
				if ($pass1==$pass2) {
					$query="INSERT INTO users (id_user,	login, password)
							VALUES ('', '$login', '$pass1')";
					$result=mysqli_query($link, $query) or die (mysqli_error($link));
					if ($result){
						$_SESSION['login'] = $login;
						header("Location: intro.php");
					} else {$message = "Регистрация не удалась";}
				} else {$message = "Пароли не совпадают";}
					
			} else {$message = "Пользователь с таким логином уже зарегистрирован.";}	
		} else {$message = "Пожалуйста, заполните поля формы.";}
	}

?>

<!doctype html>
<html>
<head>
	<meta charset = "utf-8">
	<title>Регистрация</title>
	<link href = "css/style.css" rel = "stylesheet">
</head>
<body>
	<div class="container mregister">
		<div id = "login">
			<h1>Регистрация</h1>
			<form id = "registerform" name="registration" method = "POST">
				<p><label>Придумайте логин <input name = "login" type = "text" size = "20" value="<?php echo $login ?>"></label></p>
				<p><label>Придумайте пароль <input name = "pass1" type = "password" size = "20"></label></p>
				<p><label>Подтвердите пароль <input name = "pass2" type = "password" size = "20"></label></p>
				<p><input name = "submit" type = "submit" value = "Зарегистрироваться"></p>
				<p>Уже зарегистрированы? <a href = "authorization.php">Войти</a></p>
			</form>
		</div>
	</div>
</body>
</html>

<?php	if (!empty($message)) {echo "<p class=\"error\">" .  $message . "</p>";;}
		else if (!empty($welcome)) {echo "<p class=\"welcome\">" .  $welcome . "</p>";;}
?>