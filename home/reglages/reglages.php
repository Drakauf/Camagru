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
	unset($_GET);
}

if (isset($_GET['passwd']))
{
	$hashmdp = hash('sha512', $_GET['mdp']);
	$oldmdp = hash('sha512', $_GET['oldmdp']);
	$hashcmdp = hash('sha512', $_GET['cmdp']);
	echo("old : ");
	echo($oldmdp);
	echo("\n");
	echo("tab :");
	echo($table['mdp']);
	echo("\n");
	echo("new :");
	echo($hashmdp);
	if ($hashmdp != $hashcmdp)
		$mdpsucces = 1;
	else if ($oldmdp != $table['mdp'])
		$mdpsucces = 2;
	else
	{
		$sqlmdp = $db->prepare('UPDATE User SET mdp=? WHERE pseudo LIKE ?');
		$sqlmdp->execute([$hashmdp, htmlspecialchars($_SESSION['User'])]);
		echo $_SESSION['User'];
	}
	unset($_GET);
}

?>

<html>
	<head>
		<meta charset="utf-8"/>
		<title> Camagru - Reglages</title>
	</head>
	<body>
<?php 

if (isset($notifsucces))
{ 
	if ($notifsucces == 1) 
	{ 
		echo "<p> vous receverez des notification quand vos photo seront commente</p>";
	}
	if ($notifsucces == 0)
	{
		echo "<p> vous ne receverez plus de notification si une de vos photo est commente </p>";
	}
	unset($notiftsucces);
}

if (isset($mdpsucces))
{
	if ($mdpsucces == 1)
	{
		echo "<p> Le mot de passe et le mot de passe de confirmation sont differents </p>";
	}
	if ($mdpsucces == 2)
	{
		echo "<p> L'ancien mot de passe ne correspond pas.</p>";
	}
	unset($mdpsucces);
}
?>

	<form action:"reglages.php" method:"GET">
	<label> Notifications : </label>
	<select name="notification">
			<option value="oui">Oui</option>
			<option value="non">Non</option>
		</select>
		<input type="submit" name="notif" value="modifier">
	</form>
	<form action:"reglages.php" method:"GET">
		<label> Modifier le mot de passe </label></br>
		<input type="password" name="oldmdp"></br>
		<input type="password" name="mdp"></br>
		<input type="password" name="cmdp"></br>
		<input type="submit" name="passwd" value="modifier">
	</form>
	<form>
	</body>
