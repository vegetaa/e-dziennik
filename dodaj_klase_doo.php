<?php
$klasa=$_POST['klasa'];
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
	$klasa_ = mysqli_real_escape_string($link, $klasa);
$sql = 'INSERT INTO klasy SET
klasa="' . $klasa_ . '"';
if (!mysqli_query($link, $sql))
{
$output= 'Błąd w trakcie dodawania!!';
include 'admin_panel.php';
exit();
}
else $output="Klasa została dodana.";
include 'admin_panel.php';
?>
