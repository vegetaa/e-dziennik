<!DOCTYPE HTML>
<html lang="pl">
<head>
<meta charset="utf-8">
<meta name="Author" content="Tomasz Kozik, Joanna Stefan, Sԡwomir Morawskis">
<title>E-DZIENNIK</title>
</head>
<body style="text-align:center; background-color: #E8820C;">
<h1>SPRAWDŹ OCENE</h1>
<table border>
<tr>
<td>DATA</td><td>PRZEDMIOT</td><td>NAUCZYCIEL</td><td>FORMA OCENY</td><td>WAGA OCENY</td><td>OCENA</td>
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
if($id_ucznia==$i_d)
{
$result_= mysqli_query($link, 'SELECT id, name, surname FROM nauczyciele');
while ($row_= mysqli_fetch_assoc($result_))
{
$id_nauczyciel=$row_['id'];
$name=$row_['name'];	
$surname=$row_['surname'];	
if($id_nauczyciel==$id_nauczyciela)
{
echo '<tr><td>'.$data.'</td><td>'.$przedmiot.'</td><td>'.$name.' '.$surname.'</td><td>'.$za_co.'</td><td>'.$waga.'</td><td>'.$ocena.'</td></tr>';
}
}
}
}
?>
</table>
<a href="uczen_panel.php?id=<?php echo $id_ucznia; ?>">WRÓC</a>
</body>
</html>
