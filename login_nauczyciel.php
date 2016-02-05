<?php
$login=$_POST['login'];
$password=$_POST['password'];
$password_=md5($password .'nauczyciel');
$link = mysqli_connect('sql.atise.nazwa.pl:3306', 'atise_3', 'QkacVHZ6Q');
if (!$link)
{
$output = 'Nie można się połaczyć z bazą danych!';
include 'index.php';
exit();
}
if (!mysqli_set_charset($link, 'utf8'))
{
$output = 'Nie można ustawić kodowania dla połączenia z bazą!';
include 'index.php';
exit();
}
if (!mysqli_select_db($link,'atise_3'))
{
$output= 'Nie znaleziono bazy danych!';
include 'index.php';
exit();
}
$result= mysqli_query($link, 'SELECT id, login, password, name FROM nauczyciele');
while ($row= mysqli_fetch_assoc($result))
{
$id=$row['id'];
$log=$row['login'];
$name=$row['name'];
$password_base=$row['password'];
if($login==$log)
{
	if($password_base==$password_)
	{
		setcookie("login",$log, time()+3600);
		setcookie("typ",$typ="nauczyciel", time()+3600);
		$output= 'Zostałeś zalogowany '. $name .'!!!';
		$logint=$login;
		include 'nauczyciel_panel.php';
		exit();
	}
}
}
$output="Twoje hasło lub login są błędne";
include 'index.php';
?>
