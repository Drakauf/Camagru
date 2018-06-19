<?php
session_start();
include '/var/www/html/functions/bdco.php';
$db = dataco();
$sqlall = $db->prepare('SELECT * FROM User WHERE pseudo LIKE ?');
$sqlall->execute([$_SESSION['User']]);
$table = $sqlall->fetch(PDO::FETCH_ASSOC);
if (isset($_GET['notif']))
{
	if ($_GET['notification'] == "oui")
	{
		$sqlnotif = $db->prepare('UPDATE User SET notif = 1 WHERE pseudo LIKE ?');
		$sqlnotif->execute([$_SESSION['User']]);
		$notifsucces = 1;
	}
	else if ($_GET['notification'] == "non")
	{
		$sqlnotif = $db->prepare('UPDATE User SET notif = 0 WHERE pseudo LIKE ?');
		$sqlnotif->execute([$_SESSION['User']]);
		$notifsucces = 0;
	}
}
?>

<html>
	<head>
		<meta charset="utf-8"/>
		<title> Camagru - Reglages</title>
	</head>
	<body>
<?php if (isset($notifsucces))
{ 
	if ($notifsucces == 1) 
	{ 
		echo "<p> vous receverez des notification quand vos photo seront commente</p>";} if ($notifsucces == 0) { echo "<p> vous ne receverez plus de notification si une de vos photo est commente </p>";}}?>
	<form action:"reglages.php" method:"GET">
		<select name="notification">
			<option value="oui">Oui</option>
			<option value="non">Non</option>
		</select>
		<input type="submit" name="notif" value="modifier">
	</form>
	</body>
