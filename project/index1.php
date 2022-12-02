<?php
session_start();
    $host='localhost';
    $user='root';
    $password='';   
    $db_name='Kursach';
    $link=mysqli_connect($host,$user,$password,$db_name);
        if (isset($_GET['cart'])) {
	$_SESSION['cart'][]=$_GET['cart'];
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

<div class="slider">
    <div class="item">
        <img src="tokyo.jfif" alt="Первый слайд">
    </div>

    <div class="item">
        <img src="tina.jfif" alt="Второй слайд">
    </div>

    <div class="item">
        <img src="family.jpg" alt="Третий слайд">
    </div>
    <div class="item">
        <img src="village.jpg" alt="Третий слайд">
    </div>

    <a class="prev" onclick="minusSlide()">&#10094;</a>
    <a class="next" onclick="plusSlide()">&#10095;</a>
</div>

<div class="slider-dots">
    <span class="slider-dots_item" onclick="currentSlide(1)"></span> 
    <span class="slider-dots_item" onclick="currentSlide(2)"></span> 
    <span class="slider-dots_item" onclick="currentSlide(3)"></span>
    <span class="slider-dots_item" onclick="currentSlide(4)"></span> 
</div>

<h1>Наши новинки</h1>
<div class="new_games">
    <div class="gamesCon">
    <?php
    $query="SELECT * FROM games ORDER BY price";
    $result=mysqli_query($link, $query) or die(mysqli_error($link));
    while($row=mysqli_fetch_array($result))
            {?>
    <div class="game">
        <div class="game_logo" style="background-image: url(<?php echo $row["photo"]?>); background-size: 100% 100%;"></div>
        <div class="game_name"><span><?php echo $row["name"]?></span></div>
        <div class="game_price"><span><?php echo $row["price"]?> руб</span>
        </div>
        <?php echo'<div class="in_cart"><a href="?cart='.$row['id'].'">В корзину</a></div>'; ?>
    </div>
            <?php } ?>    </div>
        <button class="checkAll">Смотреть все</button>
</div>
<h1>Отзывы</h1>
    <a name="reviews"></a>
<div class="reviews_con">
        <?php
if (isset($_GET['page'])) {
$page=$_GET['page'];
}
else {$page=1;}
$notesOnPage=3;
$from=($page-1)*$notesOnPage;
    $query="SELECT * FROM reviews WHERE Id>0 LIMIT $from,$notesOnPage";
    $result=mysqli_query($link, $query) or die(mysqli_error($link));
    while($row=mysqli_fetch_array($result))
            {?>
                <div class="review_main">
                                        <div class="review_name"><?php echo $row["name"]?></div>
                    <div class="otziv"><?php echo $row["review"]?></div>
                </div>
                  <?php } ?>
                  
<?php   $query="SELECT COUNT(*) as count FROM reviews";
$result=mysqli_query($link,$query) or die(mysqli_error($link));
$count=mysqli_fetch_assoc($result)['count'];
$pageCount=ceil($count/$notesOnPage);?>
<div class="counter_con" style="display: inline-grid;grid-template-columns: repeat(<?php echo $pageCount?>,1fr);">
    <?php
for ($i=1; $i<=$pageCount; $i++) { 
    echo "<div class='counter'><a href=\"?page=$i\">$i</a></div>"."";
}
                  ?>
                  </div>
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
<script src="script.js"></script>
</body>
</html>