<?php
session_start();
$host='localhost';
$user='root';
$password="";
$db='Kursach';
$link=mysqli_connect($host,$user,$password,$db);
$id=$_SESSION['id'];
if ($id==null) {
	header('Location: auth.php');
}
if ($_SESSION['banned']==1) {
	header('Location: ban.php');
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
<div class="enter" style="text-align: center;">Удаление аккаунта</div>
<?php
	$query="SELECT * FROM user WHERE id='$id'";
	$users=mysqli_fetch_assoc(mysqli_query($link,$query));
	if (!empty($_POST['password']) AND !empty($_POST['password_confirm'])) {
	$hash=$users['password'];
    $pass=$_POST['password'];
    $pass_confirm=$_POST['password_confirm'];
if (password_verify($pass,$hash)) {
	if ($pass==$pass_confirm) {
		$query="DELETE FROM profile WHERE user_id='$id'";
		mysqli_query($link,$query);
		$query="DELETE FROM user WHERE id='$id'";
		mysqli_query($link,$query);
		header('Location: register.php');
	}
	else{
		echo "<div class='error'>Пароли не совпадают</div>";
	}
}
else echo "<div class='error'>Пароль введён неверно</div>";}
else echo "<div class='error'>Введите необходимые данные</div>";
?>
<input type="password" class="login" name="password" minlength="8" maxlength="25" required="required" placeholder="Введите пароль"><br>
<input type="password" class="login" name="password_confirm"  minlength="8" maxlength="25"required="required" placeholder="Подтвердите пароль"><br>
	<input type="submit" id="register" value="Удалить аккаунт"><br>
</form>