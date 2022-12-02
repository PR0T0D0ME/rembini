<?php
session_start();
if ($_SESSION['id']==null) {
	header('Location: auth.php');
}
elseif ($_SESSION['status']!='admin') {
	header('Location: profile.php');
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
	<div class="enter" style="text-align: center;">Пользователи</div>
<div class="admin_table">
	<div class="zagol">login</div>
	<div class="zagol">status</div>
	<div class="zagol">delete</div>
	<div class="zagol">ban</div>
	<div class="zagol">change_pass</div>
<?php
$host='localhost';
$user='root';
$password="";
$db='Kursach';
$link=mysqli_connect($host,$user,$password,$db);
$id=$_SESSION['id'];
?>
<?php
if (isset($_GET['del'])){
$del=$_GET['del'];
$query="DELETE FROM profile WHERE user_id=$del";
mysqli_query($link,$query) or die (mysqli_error($link));
$query="DELETE FROM user WHERE id=$del";
mysqli_query($link,$query) or die (mysqli_error($link));}
if (isset($_GET['ban'])) {
	$ban=$_GET['ban'];
	$query="UPDATE user SET banned=1 WHERE id=$ban";
	mysqli_query($link,$query) or die (mysqli_error($link));
}
if (isset($_GET['change'])) {
	$_SESSION['change_id']=$_GET['change'];
header('Location: admin_change.php');
}
if (isset($_GET['ban1'])) {
	$ban1=$_GET['ban1'];
	$query="UPDATE user SET banned=0  WHERE id=$ban1";
	mysqli_query($link,$query) or die (mysqli_error($link));
}
$query="SELECT email, status, id, banned FROM user ORDER BY id";
    $result=mysqli_query($link, $query) or die(mysqli_error($link));
    while($row=mysqli_fetch_array($result)){
echo '<div class="email_con">'.$row['email']." </div>";
	if ($row['status']=='user') {
		echo '<div style="background:green">'.$row['status']."</div>";
	}
	else if ($row['status']=='admin'){echo '<div style="background:red; color:white;">'.$row['status']." </div>";}
	echo'<div><a href="?del='.$row['id'].'">удалить</a></div>';
	if ($row['banned']==0) {
echo'<div><a href="?ban='.$row['id'].'">забанить</a></div>';}
else echo '<div><a href="?ban1='.$row['id'].'">разбанить</a></div>';
echo '<div><a href="?change='.$row['id'].'">Изменить пароль</a></div>';
}
?>
</div>
<div id="return"><input type="button" value="Вернуться в профиль" onClick="window.location='profile.php'"></div></body></html>