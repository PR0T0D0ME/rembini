<?php
session_start();
if ($_SESSION['id']==null) {
	header('Location: auth.php');
}
else if ($_SESSION['banned']==0) {
	header('Location: profile.php');
}
$host='localhost';
$user='root';
$password="";
$db='Kursach';
$link=mysqli_connect($host,$user,$password,$db);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="default1.css">
	<title>Бан</title>
</head>
<body>
<div class="bandude">
	<div class="clown"></div>
	<div>Не будь, как человек на картинке и в следующий раз соблюдай правила сайта. Если вас забанили по ошибке - свяжитесь с админами.</div>
</div>
</body>
</html>