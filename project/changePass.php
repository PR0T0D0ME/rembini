<?php
session_start();
if ($_SESSION['banned']==1) {
	header('Location: ban.php');
}
$host='localhost';
$user='root';
$password="";
$db='Kursach';
$link=mysqli_connect($host,$user,$password,$db);
$id=$_SESSION['id'];
if ($id==null) {
	header('Location: auth.php');
}
?>
<!doctype html>
<html lang="ru">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="default1.css">
<title>GabenMarket</title>
</head>
<body>
<header>
	<div class="container">  
        <a href="index1.php" id="logo"><img src="2.svg" height="100px" width="100px"></a>
        <label for="toggle-1" class="toggle-menu"><i class="toggle-icon"></i></label>
        <input type="checkbox" id="toggle-1">
        <nav>
            <ul>
                <li><a href="index1.php">Главная</a></li>
                <li><a href="#catalog">Каталог игр</a></li>
                <li><a href="#buys">Мои покупки</a></li>
                <li><input type="search" name="search" class="search"></li>
                <li><a href="cart.php" class="cartLink"><img src="cart.png" class="cartIcon" width="50px" height="50px">
                <span class="cartLabel">Корзина</span></a></li>
                <li><a href="profile.php" class="profileLink"><img src="user.png" class="userIcon" width="50px" height="50px">
                <span class="userLabel">Профиль</span></a>
                </li>
            </ul>
        </nav>
    </div>
</header>
<div class="form">
<form method="POST">
<div class="enter" style="text-align: center;">Смена пароля</div>
<?php
	$query="SELECT * FROM user WHERE id='$id'";
	$user=mysqli_fetch_assoc(mysqli_query($link,$query));
	$hash=$user['password'];
    if (!empty($_POST['old_password']) AND !empty($_POST['new_password']) AND !empty($_POST['new_password_confirm'])) {
    if ($old_password!=$new_password) {
    	    $old_password=$_POST['old_password'];
    $new_password=$_POST['new_password'];
    $new_password_confirm=$_POST['new_password_confirm'];
if (password_verify($old_password,$hash)) {
	$new_passwordHash=password_hash($new_password,PASSWORD_DEFAULT);
	$new_password_confirmHash=password_hash($new_password_confirm,PASSWORD_DEFAULT);
	if ($new_password==$new_password_confirm) {
		$query="UPDATE user SET password='$new_passwordHash' WHERE id='$id'";
		mysqli_query($link,$query);
	}
	else{
		echo "<div class='error'>Пароли не совпадают</div>";
	}
}
else echo "<div class='error'>Старый пароль введён неверно</div>";
}
else echo "<div class='error'>Новый пароль совпадает со старым</div>";}
else echo "<div class='error'>Введите все необходимые данные</div>";
?>
<input type="password" class="login" name="old_password" minlength="8" maxlength="25" required="required" placeholder="Введите старый пароль">
<input type="password" class="login" name="new_password" minlength="8" maxlength="25" required="required" placeholder="Введите новый пароль">
<input type="password" class="login" name="new_password_confirm" minlength="8" maxlength="25" required="required" placeholder="Подтвердите пароль"><br>
	<input type="submit" id="register" value="Сменить пароль"><br>
</form></div>