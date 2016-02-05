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
	$output="Hasła ucznia różnią się od siebie!";
	include 'index.php';
	exit();
}
$password_=md5($password .'uczen');
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
$result= mysqli_query($link, 'SELECT id, login FROM uczniowie');
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
$sql = 'INSERT INTO uczniowie SET
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
else{
	$title="Rejestracja ucznia w serwisie E-DZIENNIK.";
	$body='Zostałeś zarejestrowany '.$name.' w serwisie E-DZIENNIK. <br>Twój login do serwisu to: '.$login.', natomiast hasło to: '.$password.'<br>Zaloguj się wkrótce!';
	   $headers = 'MIME-Version: 1.0' . " \r\n";
      $headers .= 'Content-type: text/html; charset=UTF-8' . " \r\n";
      $headers .= 'From: E-DZIENNIK '." \r\n";
if(mail($email, $title, $body, $headers)) $output="Wiadomość została wysłana na adres ".$email.".</br>";
else $output="Nieudało się wysłać wiadomości.";
}
include 'admin_panel.php';
?>
