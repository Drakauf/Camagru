<?php
session_start();

if (!(isset($_SESSION['User'])))
	echo '<script type="text/javascript"> location.href = "/"; </script>';

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
	if (isset($_GET['mdp'], $_GET['oldmdp'], $_GET['cmdp']))
	{
		if (strlen($_GET['mdp']) < 8 || ctype_alpha($_GET['mdp']) || is_numeric($_GET['mdp']))
		{
			$mdpsucces = 3;
		}
		else
		{
			$hashmdp = hash('sha512', $_GET['mdp']);
			$oldmdp = hash('sha512', $_GET['oldmdp']);
			$hashcmdp = hash('sha512', $_GET['cmdp']);
			if ($hashmdp != $hashcmdp)
				$mdpsucces = 1;
			else if ($oldmdp != $table['mdp'])
				$mdpsucces = 2;
			else
			{
				$sqlmdp = $db->prepare('UPDATE User SET mdp=? WHERE pseudo LIKE ?');
				$sqlmdp->execute([$hashmdp, htmlspecialchars($_SESSION['User'])]);
				$mdpsucces = 5;
			}
			unset($_GET);
		}
	}
	else
		$mdpsucces = 0;
}

if (isset($_GET['modifmail']))
{
	if (isset($_GET["oldmail"], $_GET['pseudo'], $_GET['newmail']))
	{
		if ($table['mail'] != $_GET['oldmail'])
			$mailsucces = 1;
		else if (!preg_match("#^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$#", $_GET['newmail']))
			$mailsucces = 2;
		else
		{
			$sqlmail = $db->prepare('UPDATE User SET mail=? WHERE pseudo LIKE ?');
			$sqlmail->execute([$_GET['newmail'], $_SESSION['User']]);
		}
	}
	else
		$mailsuccess = 0;
}

if (isset($_GET['modifname']))
{
	if (strlen($_GET['npseudo']) > 26 || strlen($_GET['npseudo']) < 2)
		$namesucces = 1;
	else
	{
		$changename = $db->prepare('SELECT * FROM User WHERE pseudo = ?');
		$changename->execute([$_GET['npseudo']]);
		if ($changename->rowCount() != 0)
			$namesucces = 2;
		else
		{
			$change = $db->prepare('UPDATE User SET pseudo=? WHERE pseudo LIKE ?');
			$change->execute([$_GET['npseudo'], $_SESSION['User']]);
			$namesucces = 3;
		}
		unset($_GET);
}
}
?>

<html>
<head>
		<meta charset="utf-8" />
		<title>Camagru</title>
		<link rel="stylesheet" href="../head_foot/header.css">
		<link rel="stylesheet" href="reglages.css">
		<link rel="stylesheet" href="../head_foot/menu.css">
<script type="text/javascript">
var log='<?php echo $_SESSION['User'] ?>'
	</script>
</head>
<body>



	<?php include '../head_foot/header.php'; ?>
<div id="body">
	<?php include '../head_foot/menu.php'; ?>
<div id=reglages>
<h1 style="color: white"> Reglages </h1>
	<form class=reglaform action:"reglages.php" method:"GET">

	<label> Notifications : </label>
<?php if (isset($notifsucces)){ 
if ($notifsucces == 1) 
	echo "<p> vous receverez des notification quand vos photo seront commente</p>";
if ($notifsucces == 0)
	echo "<p> vous ne receverez plus de notification si une de vos photo est commente </p>";
unset($notiftsucces);}?>
	<select name="notification">
			<option value="oui">Oui</option>
			<option value="non">Non</option>
		</select>
		<input type="submit" name="notif" value="modifier">
	</form>

	<form class=reglaform action:"reglages.php" method:"GET">
		<legend> Modifier le mot de passe </legend></br>
<?php if (isset($mdpsucces)){
if ($mdpsucces == 0)
	echo "<p> Veuillez remplir tout les champs </p>";
if ($mdpsucces == 1)
	echo "<p> Le mot de passe et le mot de passe de confirmation sont differents </p>";
if ($mdpsucces == 2)
	echo "<p> L'ancien mot de passe ne correspond pas.</p>";
if ($mdpsucces == 3)
	echo "<p> Mot de passe non securise, 8caracteres min avec lettres + chiffres.</p>";
if ($mdpsucces == 5)
	echo "<p> Mot de passe modifie</p>";
unset($mdpsucces);}?>
		<label> Ancien mot de passe: </label>
		<input type="password" name="oldmdp"></br>
		<label> Nouveau mot de passe: </label>
		<input type="password" name="mdp"></br>
		<label> Confirmer mot de passe: </label>
		<input type="password" name="cmdp"></br>
		<input type="submit" name="passwd" value="modifier">
	</form>

	<form class=reglaform action:"reglages.php" method:"GET">
	<legend> Modifier l'addresse mail </legend>
<?php if (isset($mailsucces)){
if ($mailsucces == 0)
	echo "<p> Veuillez remplir tout les champs </p>";
if ($mailsucces == 1)
	echo "<p> Les information donnees sont erronees</p>";
if ($mailsucces == 2)
	echo "<p>Addresse mail non valide </p>";}?>
	<label> Ancien Mail: </label>
	<input type="text" name="oldmail"></br>
	<label> Pseudo: </label>
	<input type="text" name="pseudo"></br>
	<label> Nouveau Mail: </label>
	<input type="text" name="newmail"</br>
	<input type="submit" name="modifmail" value="modifier">
	</form>
<form class=reglaform action:"reglages.php" method:"GET">
<legend> Changer de pseudo </legend>
<?php if (isset($namesucces)){
if ($namesucces == 0)
	echo "<p> Veuillez remplir tout les champs </p>";
if ($namesucces == 1)
	echo "<p> Pseudo trop non trop long / trop cour</p>";
if ($namesucces == 2)
	echo "<p> Pseudo deja utilise </p>";
if ($namesucces == 3)
	echo "<p> Pseudo modifie </p>";}?>
	<label> Nouveau Pseudo: </label>
	<input type="text" name="npseudo"></br>
	<input type="submit" name="modifname" value="modifier">
	</form>
</div></div>
	<?php include '../head_foot/footer.php'; ?>
	<script src="../head_foot/menu.js"></script>
	<script src="../head_foot/header.js"></script>
</body>
</html>
