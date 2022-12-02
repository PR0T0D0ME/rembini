<?php
session_start();
$host='localhost';
$user='root';
$password="";
$db='kursach';
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
	<div class="enter">Регистрация</div>
<?php
if (isset($_POST['ok'])) {
if (!empty($_POST['password']) AND !empty($_POST['confirm']) AND !empty($_POST['email'])) {
	if ($_POST['password']==$_POST['confirm']) {
	$pass=password_hash($_POST['password'], PASSWORD_DEFAULT);
	$email=$_POST['email'];
	$query="SELECT * FROM user WHERE email='$email'";
	$user=mysqli_fetch_assoc(mysqli_query($link,$query));
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo "<div class='error'>Попробуйте другой email</div>";
	}
	else{
	if (empty($user)) {
			$query="INSERT INTO user SET password='$pass', email='$email', status='user', banned=0";
mysqli_query($link,$query)or die (mysqli_error($link));
$_SESSION['auth']=true;
$id=mysqli_insert_id($link);
$_SESSION['id']=$id;
$_SESSION['status']=$user;
$_SESSION['banned']=$user['banned'];
header('Location: profile.php');
}
else{
	echo "<div class='error'>Введите другой email</div>";
}
}
}
else{
	echo "<div class='error'>Попробуйте ещё раз</div>";
}
}
}
?>
<input type="email" class="login" name="email" minlength="5" maxlength="50" required="required" placeholder="Введите email"><br>
<input type="password" class="login" name="password" minlength="8" maxlength="25" required="required" placeholder="Введите пароль"><br>
<input type="password" class="login" name="confirm"  minlength="8" maxlength="25"required="required" placeholder="Подтвердите пароль"><br>
	<div class="sogl"> <div class="checkbox">
    <input class="custom-checkbox" type="checkbox" id="color-1" name="color-1" value="indigo" required="required">
    <label for="color-1">Я ознакомлен и подтверждаю свое согласие с Правилами пользования сайтом и с Политикой Администрации в отношении обработки персональных данных</label>
  </div></div>
	<input type="submit" id="register" name="ok" value="Зарегистрироваться"><br>
		<div class="Reg">
		<a href="auth.php">Авторизируйтесь</a>, если у вас уже есть профиль.
	</div>
</form>
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