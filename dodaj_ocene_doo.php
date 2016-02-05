<?php
$nauczyciel=$_POST['nauczyciel'];
$uczen=$_POST['uczen'];
$data=$_POST['data'];
$za_co=$_POST['za_co'];
$waga=$_POST['waga'];
$ocena=$_POST['ocena'];

$link = mysqli_connect('sql.atise.nazwa.pl:3306', 'atise_3', 'QkacVHZ6Q');
if (!$link)
{
$output = 'Nie mo࠮a siꡰoԡczy桺 baz٠danych!';
include 'index.php';
exit();
}
if (!mysqli_set_charset($link, 'utf8'))
{
$output = 'Nie mo࠮a ustawi桫odowania dla poӹczenia z baz١';
include 'index.php';
exit();
}
if (!mysqli_select_db($link,'atise_3'))
{
$output= 'Nie znaleziono bazy danych!';
include 'index.php';
exit();
}
$result= mysqli_query($link, 'SELECT id, login, przedmiot FROM nauczyciele');
while ($row= mysqli_fetch_assoc($result))
{
$id=$row['id'];
$login_nauczyciel=$row['login'];
$przedmiot=$row['przedmiot'];
if($nauczyciel==$login_nauczyciel)
{
	$nauczyciel_ = mysqli_real_escape_string($link, $id);
	$uczen_ = mysqli_real_escape_string($link, $uczen);
	$przedmiot_ = mysqli_real_escape_string($link, $przedmiot);
	$data_ = mysqli_real_escape_string($link, $data);
	$za_co_ = mysqli_real_escape_string($link, $za_co);
	$waga_ = mysqli_real_escape_string($link, $waga);
	$ocena_ = mysqli_real_escape_string($link, $ocena);
$sql = 'INSERT INTO oceny SET
id_nauczyciela="' . $nauczyciel_ . '",
id_ucznia="' . $uczen_ . '",
przedmiot="' . $przedmiot_ . '",
data="' . $data_ . '",
za_co="' . $za_co_ . '",
waga="' . $waga_ . '",
ocena="' . $ocena_ . '"';
if (!mysqli_query($link, $sql))
{
$output= 'Błąd w trakcie dodawania!!';
include 'nauczyciel_panel.php';
exit();
}
}
}
$output= 'Dodano ocene!';
include 'nauczyciel_panel.php';
?>
