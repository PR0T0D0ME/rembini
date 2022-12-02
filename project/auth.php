<?php
session_start();
$host='localhost';
$user='root';
$password="";
$db='Kursach';
$link=mysqli_connect($host,$user,$password,$db);
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
        <a href="index1.php" id="logo"><img src="2.svg" style='height:100px; width:100px;' alt="logo"></a>
        <label for="toggle-1" class="toggle-menu"><i class="toggle-icon"></i></label>
        <input type="checkbox" id="toggle-1">
        <nav>
            <ul>
                <li><a href="index1.php">Главная</a></li>
                <li><a href="#catalog">Каталог игр</a></li>
                <li><a href="#buys">Мои покупки</a></li>
                <li><input type="search" name="search" class="search"></li>
                <li><a href="cart.php" class="cartLink"><img src="cart.png" class="cartIcon" style='height:50px; width:50px;' alt="cart">
                <span class="cartLabel">Корзина</span></a></li>
                <li><a href="profile.php" class="profileLink"><img src="user.png" class="userIcon" style='height:50px; width:50px;' alt="profile">
                <span class="userLabel">Профиль</span></a>
                </li>
            </ul>
        </nav>
    </div>
</header>
<div class="form">
<form method="POST">
	<div class="enter">Вход</div>
	<?php
	if (isset($_POST['ok'])) {
if (!empty($_POST['email']) AND !empty($_POST['password'])){
	$email=$_POST['email'];
	$pass=$_POST['password'];
	$query="SELECT * FROM user WHERE email='$email'";
	$user=mysqli_fetch_assoc(mysqli_query($link,$query));
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo "<div class='error'>Попробуйте другой email</div>";
	}
	else{
	if (!empty($user)) {
		$hash=$user['password'];
		if (password_verify($pass,$hash)) {
			$_SESSION['auth']=true;
			$_SESSION['id']=$user['id'];
			$_SESSION['status']=$user['status'];
			$_SESSION['banned']=$user['banned'];
			header('Location: profile.php');
		}
		else {
			echo "<div class='error'>Попробуйте другой пароль!"."</div>";
		}
}
else {
	echo "<div class='error'>Пользователя с таким email нет</div>";
}
}
}
else {
	echo "<div class='error'>Введите все необходимые данные</div>";
}
}
?>
<input type="email" class="login" name="email" minlength="5" maxlength="50" required="required" placeholder="Введите email"><br>
<input type="password" class="login" name="password" minlength="8" maxlength="25" required="required" placeholder="Введите пароль"><br>
	<div class="forget"><a href="non_profile_forget.php">Забыли пароль?</a></div><input type="submit" name="ok" id="log_in" value="Войти"><br>
	<div class="Reg">
		Вы впервые на сайте? <a href="register.php">Зарегистрируйтесь</a>
	</div>
</form>
</div>
<footer>
    <div class="footer_con">
        <div class="specialThings">Лицензионные ключи от официальных издателей</div>
        <div class="specialThings">Гарантированная техподдержка вашей покупки</div>
        <div class="specialThings">Регулярные акции, скидки и бонусы</div>
        <div class="specialThings">Множество положительных отзывов от реальных клиентов</div>
        <div class="aboutUs">
© 2022 GABENMARKET
Все права защищены. Полное или частичное копирование материалов сайта без согласования с администрацией запрещено!
Все названия игр, компаний, торговых марок, логотипы и игровые материалы являются собственностью соответствующих владельцев.
        </div>
        <div class="toMain"><a href="index1.php">На главную</a></div>
    </div>
</footer>