<?php
	require("constants.php");
	$link = mysqli_connect(DB_SERVER, DB_USER, DB_PASS) or die(myqli_error());
	mysqli_select_db($link, DB_NAME) or die("Cannot select DB");
?>