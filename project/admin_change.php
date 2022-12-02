<?php
session_start();
if ($_SESSION['id']==null) {
	header('Location: auth.php');
}
elseif ($_SESSION['status']!='admin') {
	header('Location: profile.php');
}
elseif ($_SESSION['change_id']==null)
{
	header('Location: admin.php');
}
$host='localhost';
$user='root';
$password="";
$db='Kursach';
$link=mysqli_connect($host,$user,$password,$db);
$change=$_SESSION['change_id'];
?>
<!doctype html>
<html lang="ru">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="default1.css">
<title>Change_Password</title>
</head>
<body>
	<div class="form">
	<form method="POST">
		<?php
	$query="SELECT * FROM user WHERE id='$change'";
	$user=mysqli_fetch_assoc(mysqli_query($link,$query));
	$hash=$user['password'];
    if (!empty($_POST['new_password']) AND !empty($_POST['new_password_confirm'])) {
    if ($hash!=$new_password) {
    $new_password=$_POST['new_password'];
    $new_password_confirm=$_POST['new_password_confirm'];
	$new_passwordHash=password_hash($new_password,PASSWORD_DEFAULT);
	if ($new_password==$new_password_confirm) {
		$query="UPDATE user SET password='$new_passwordHash' WHERE id='$change'";
		mysqli_query($link,$query);
		header('Location:admin.php');
	}
	else{
		echo "<div class='error'>Пароли не совпадают</div>";
	}
}
else echo "<div class='error'>Новый пароль совпадает со старым</div>";}
else echo "<div class='error'>Введите все необходимые данные</div>";
?>
<input type="password" class="login" name="new_password" minlength="8" maxlength="25" required="required" placeholder="Введите новый пароль">
<input type="password" class="login" name="new_password_confirm" minlength="8" maxlength="25" required="required" placeholder="Подтвердите пароль"><br>
	<input type="submit" id="register" value="Сменить пароль"><br>
	</form></div>
</body>