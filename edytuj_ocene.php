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
<meta name="Author" content="Tomasz Kozik, Joanna Stefan, Sԡwomir Morawskis">
<title>E-DZIENNIK</title>
</head>
<body style="text-align:center; background-color: #E8820C;">
<h1>EDYTUJ OCENE</h1>
<table border>
<tr>
<td>DATA</td><td>PRZEDMIOT</td><td>UCZEŃ</td><td>FORMA OCENY</td><td>WAGA OCENY</td><td>OCENA</td><td>DZIAŁANIE</td>
</tr>
<?php
$i_d=$_GET['id'];
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
$result_= mysqli_query($link, 'SELECT id, login FROM nauczyciele');
while ($row_= mysqli_fetch_assoc($result_))
{
$id_nauczyciel=$row_['id'];
$login_nauczyciela=$row_['login'];	
if($login_nauczyciela==$login_cookie)
{
$result= mysqli_query($link, 'SELECT id, id_nauczyciela, id_ucznia, przedmiot, data, za_co, waga, ocena FROM oceny');
while ($row= mysqli_fetch_assoc($result))
{
$id=$row['id'];
$id_nauczyciela=$row['id_nauczyciela'];
$id_ucznia=$row['id_ucznia'];
$przedmiot=$row['przedmiot'];
$data=$row['data'];
$za_co=$row['za_co'];
$waga=$row['waga'];
$ocena=$row['ocena'];
if($id_nauczyciela==$id_nauczyciel)
{
$result_a= mysqli_query($link, 'SELECT id, name, surname FROM uczniowie');
while ($row_a= mysqli_fetch_assoc($result_a))
{
$id_uczen=$row_a['id'];
$name_uczen=$row_a['name'];	
$surname_uczen=$row_a['surname'];
if($id_uczen==$id_ucznia)
{
echo '<tr><td>'.$data.'</td><td>'.$przedmiot.'</td><td>'.$name_uczen.' '.$surname_uczen.'</td><td>'.$za_co.'</td><td>'.$waga.'</td><td>'.$ocena.'</td><td><a href="edytuj_ocene_form.php?id='.$id.'">EDYTUJ</a></td></tr>';
}
}
}
}
}
}
?>
</table>
<a href="uczen_panel.php?id=<?php echo $id_ucznia; ?>">WRÓC</a>
</body>
</html>
