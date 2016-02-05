<!DOCTYPE HTML>
<html lang="pl">
<head>
<meta charset="utf-8">
<meta name="Author" content="Tomasz Kozik, Joanna Stefan, Sԡwomir Morawskis">
<title>E-DZIENNIK</title>
</head>
<body style="text-align:center; background-color: #E8820C;">
<h1>PANEL UCZNIA</h1>
<p><?php echo $output; ?></p>
<?php 
$id=$_GET['id'];
if($id=='')
{
$_id=$i_d;
}
else $_id=$id;
?>
<a href="sprawdz_ocene.php?id=<?php echo $_id; ?>">SPRAWDZ OCENE</a><br>
<a href="haslo_zmien.php">ZMIEŃ HASŁO</a><br>
</body>
</html>
