<!DOCTYPE HTML>
<html lang="pl">
<head>
<meta charset="utf-8">
<meta name="Author" content="Tomasz Kozik, Joanna Stefan">
<title>E-DZIENNIK</title>
</head>
<body style="text-align:center; background-color: #E8820C;">
<h1>PRZYDZIEL KLASE</h1>
<form action="przydziel_klase_doo.php" method="post">
<p>KLASA</p></br>
<select>
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
<select>
<?php
$result= mysqli_query($link, 'SELECT id, klasa FROM klasy');
while ($row= mysqli_fetch_assoc($result))
{
$id=$row['id'];
$klasa=$row['klasa'];
echo '<option value="'.$id.'">'.$klasa.'</option>';
}
?>
</select>
<input type="submit" value="Wyślij"/>
</form>
</body>
</html>
