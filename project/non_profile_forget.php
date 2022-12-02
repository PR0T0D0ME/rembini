<?php
session_start();
$host='localhost';
$user='root';
$password="";
$db='Kursach';
$link=mysqli_connect($host,$user,$password,$db);
?>
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
	<div class="enter">Забыли пароль</div>
<div class="ressurection">
	<h3>Оставьте свою электронную почту, и наши админы обязательно с вами свяжутся!</h3>
	<input type="email" class="login" name="email" minlength="5" maxlength="50" required="required" placeholder="Введите email"><br>
	<input type="submit" id="register" value="Восстановить пароль"><br>
</div></form></div>
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