<?php 
if(!isset($_COOKIE['login']))
{
	$output="Aby dodawać oceny najpierw się zaloguj!";
	include "index.php";
	exit();
}
else {
$login_cookie=$_COOKIE['login'];
$typ_cookie=$_COOKIE['typ'];
if($typ_cookie!="nauczyciel")
{
	$output="Aby dodawać oceny zaloguj się na typ konta nauczyciela!";
	include "index.php";
	exit();
}
}

?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
<meta charset="utf-8">
<meta name="Author" content="Tomasz Kozik, Joanna Stefan, S?womir Morawskis">
<title>E-DZIENNIK</title>
</head>
<body style="text-align:center; background-color: #E8820C;">
<h1>DODAJ OCENE</h1>
<form action="dodaj_ocene_doo.php" method="post">
<input type="hidden" name="nauczyciel" value="<?php echo $login_cookie; ?>">
<?php

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
?>
<p>UCZEN</p></br>
<select name="uczen">
<?php
$result= mysqli_query($link, 'SELECT id, login, name, surname FROM uczniowie');
while ($row= mysqli_fetch_assoc($result))
{
$id=$row['id'];
$log=$row['login'];
$name=$row['name'];
$surname=$row['surname'];
echo '<option value="'.$id.'">'.$name.' '.$surname.'</option>';
}
?>
</select>
<p>DATA</p></br>
<input type="text" name="data"/></br>
<p>ZA CO OCENA</p>
<input type="text" name="za_co"/></br>
<p>WAGA OCENY</p>
<select name="waga">
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
</select>
<p>OCENA</p>
<select name="ocena">
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
</select>
<input type="submit" value="Wyślij"/>
</form>
</body>
</html>
