<?php
$login=$_POST['login'];
$password=$_POST['password'];
$password2=$_POST['password2'];
$name=$_POST['name'];
$surname=$_POST['surname'];
$email=$_POST['email'];
$phone=$_POST['phone'];
if( $password!= $password2)
{
	$output="Twoje hasła różnią się od siebie!";
	include 'index.php';
	exit();
}
$password_=md5($password .'admin');
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
$czas=time()+7200;
$result= mysqli_query($link, 'SELECT id, login FROM admini');
while ($row= mysqli_fetch_assoc($result))
{
$id=$row['id'];
$log=$row['login'];
if($login==$log)
{
	$output='Podany login jest już używany!';
	include 'index.php';
	exit();
}
}
	$login_ = mysqli_real_escape_string($link, $login);
	$password__ = mysqli_real_escape_string($link, $password_);
	$name_ = mysqli_real_escape_string($link, $name);
	$surname_ = mysqli_real_escape_string($link, $surname);
	$email_ = mysqli_real_escape_string($link, $email);
	$phone_ = mysqli_real_escape_string($link, $phone);
$sql = 'INSERT INTO admini SET
login="' . $login_ . '",
password="' . $password__ . '",
name="' . $name_ . '",
surname="' . $surname_ . '",
email="' . $email_ . '",
phone="' . $phone_ . '"';
if (!mysqli_query($link, $sql))
{
$output= 'Błąd w trakcie dodawania!!';
include 'index.php';
exit();
}
include 'admin_panel.php';
?>
