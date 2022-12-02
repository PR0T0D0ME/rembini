<?php
session_start();
if ($_SESSION['id']==null) {
	header('Location: auth.php');
}
    $host='localhost';
    $user='root';
    $password='';   
    $db_name='Kursach';
    $link=mysqli_connect($host,$user,$password,$db_name);
            if (isset($_GET['out_cart'])) {
	array_splice($_SESSION['cart'], $i, 1);
	header('Location:cart.php');
}
$user_id=$_SESSION['id'];
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
<body>
    <?php
    if (empty($_SESSION['cart'])) {
    	echo "<div class='error'>На данный момент корзина пуста</div>";}
    	else{
    		?>	<div class="enter" style="text-align: center;">Корзина</div>
	<div class="new_games">
    <div class="gamesCon"><?php
$permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    		    $incart=$_SESSION['cart'];
    if (isset($_GET['page'])) {
$page=$_GET['page'];
}
else {$page=1;}
$notesOnPage=14;
$from=($page-1)*$notesOnPage;
    for ($i=$from; $i<$page*$notesOnPage; $i++) { 
    	if ($i==count($incart)) {
    		break;
    	}
    $query="SELECT * FROM games WHERE id=$incart[$i]";
    $result=mysqli_query($link, $query) or die(mysqli_error($link));
    while($row=mysqli_fetch_array($result))
            {?>
    <div class="game">
        <div class="game_logo" style="background-image: url(<?php echo $row["photo"]?>); background-size: 100% 100%;"></div>
        <div class="game_name"><span><?php echo $row["name"]?></span></div>
        <div class="game_price"><span><?php echo $row["price"]?> руб</span></div>
        <?php
         echo'<div class="in_cart"><a href="?out_cart='.$i.'">Удалить</a></div>'; 
          if (isset($_POST['buy'])) {
        	$newkey=substr(str_shuffle($permitted_chars), 0, 5).'-'.substr(str_shuffle($permitted_chars), 0, 5).'-'.substr(str_shuffle($permitted_chars), 0, 5);
        	$gameID=$incart[$i];
        	$segodnya=date("Y-m-d");
        	$query1="INSERT INTO profile SET user_id='$user_id', game_id='$gameID', buy_date='$segodnya', game_key='$newkey'";
        	mysqli_query($link,$query1)or die (mysqli_error($link));
        	$newkey="";
        	$_SESSION['cart']=null;
        	header("Location:index1.php");
        }?>
    </div>
            <?php }} ?> </div> <?php
$count=count($incart);
$pageCount=ceil($count/$notesOnPage);?>
<div class="counter_con2" style="display: inline-grid;grid-template-columns: repeat(<?php echo $pageCount?>,1fr);">
    <?php
for ($i=1; $i<=$pageCount; $i++) { 
    echo "<div class='counter'><a href=\"?page=$i\">$i</a></div>"."";
}
                  ?></div></div>
                  <?php
                  $a=0;
    for ($i=$from; $i<$page*$notesOnPage; $i++) { 
    	if ($i==count($incart)) {
    		break;
    	}
    $query="SELECT SUM(price) FROM games WHERE id=$incart[$i]";
    $result=mysqli_query($link, $query) or die(mysqli_error($link));
    while($row=mysqli_fetch_array($result))
            {
            	$a+=$row[0];
            }}
            echo "<div class='last_price'>Итоговая стоимость заказа - ".$a." рублей</div>";
            echo "<form method='POST'><div class='button_buy'><input class='buy' type='submit' name='buy' value='Купить' style='text-align:center'></div></form>";}
                   ?>
</body></html>