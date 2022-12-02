<?php
session_start();
if ($_SESSION['id']==null) {
	header('Location: auth.php');
}
if ($_SESSION['banned']==1) {
	header('Location: ban.php');
}
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
<div class="enter" style="text-align: center;">Ваши покупки</div>
<div class="profileCon">
<div class="aboutU">
	<div class="profEmail">
		<?php
		$id=$_SESSION['id'];
$query="SELECT * FROM user WHERE id='$id'";
$result=mysqli_query($link,$query) or die(mysqli_error($link));
while($row=mysqli_fetch_array($result))
            {
echo $row['email'];}
		?>
	</div>
	<?php
	if ($_SESSION['status']=='admin') {
echo "<div class='abobus'><a href='admin.php'>Админ-панель</a></div>";
	}?>
<div class="newPass"><a href="changePass.php">Сменить пароль</a></div>
<div class="deleteAcc"><a href="Delete.php">Удалить аккаунт</a></div>

	<div class="logout">
		<a href="exit.php" id="logout">Выход</a>
	</div>
</div>
<div class="yourGames"> 
	<?php
	if (isset($_GET['page'])) {
$page=$_GET['page'];
}
else {$page=1;}
$notesOnPage=5;
$from=($page-1)*$notesOnPage;
    $query="SELECT games.name, games.price, profile.game_key, profile.buy_date, user.id FROM profile 
     LEFT JOIN user ON profile.user_id=user.id
     LEFT JOIN games ON profile.game_id=games.id WHERE user.id=$id LIMIT $from,$notesOnPage";
    $result=mysqli_query($link, $query) or die(mysqli_error($link));
    while($row=mysqli_fetch_array($result))
            {?>
	<div class="yourGame">
		<div class="Your_game_name"><span><?php echo $row["name"]?></span></div>
        <div class="Your_game_price"><span><?php echo $row["price"]?> руб</span></div>
        <div class="Buy_Date"><span><?php echo $row["buy_date"]?></span></div>
        <input type="button" name="aaa" value="Ваш ключ от игры" data-popup="<?php echo $row["game_key"]?>">
        <div class="popup">
  <button>X</button>
  <span></span>
</div>
</div>
  <?php } 
  $query="SELECT COUNT(*) as count FROM profile WHERE user_id='$id'";
$result=mysqli_query($link,$query) or die(mysqli_error($link));
$count=mysqli_fetch_assoc($result)['count'];
$pageCount=ceil($count/$notesOnPage);?>
<div class="counter_con1" style="display: inline-grid;grid-template-columns: repeat(<?php echo $pageCount?>,1fr);">
    <?php
for ($i=1; $i<=$pageCount; $i++) { 
    echo "<div class='counter'><a href=\"?page=$i\">$i</a></div>"."";
}
                  ?>
</div>
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
</body>
<script src="http://code.jquery.com/jquery-2.0.2.min.js"></script>
<script>
$(function() {
  $('button', 'div.popup').on('click', function() {
    var $$ = $(this),
        $body = $('body');
    
    $body.data('index', $body.data('index') - 1);
    $$.parent().remove();
  });
  
  $('input[data-popup]').on('click', function() {
    var $$ = $(this),
        $body = $('body'),
        $popup = $('div.popup').first().clone(true);
    
    if (!$body.data('index')) {
      $body.data('index', 999);
    } else {
      $body.data('index', $body.data('index') + 1);
    }
    
    $popup
      .appendTo($('body'))
      .show()
      .find('span')
      .text($$.data('popup'))
      .parent()
      .css({
        'top': $$.offset().top,
        'left': $$.offset().left,
        'z-index': $body.data('index')
      });
  });
  
});
</script>
</html>