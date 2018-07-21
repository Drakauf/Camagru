<?php
/* --------------- --------------- --------------- Inscription --------------- --------------- --------------- */

if (isset($_GET['submit']) && $_GET['submit'] == 'inscription')
{
	if (!empty($_GET['ipseudo']) && !empty($_GET['imail']) && !empty($_GET['ipasswd']) && !empty($_GET['icopass']))
	{
		if ($_GET['icopass'] != $_GET['ipasswd'])
		{
			$insfail = 2;
		}
		else if (strlen($_GET['ipasswd']) < 8 || ctype_alpha($_GET['ipasswd']) || is_numeric($_GET['ipasswd']))
		{
			$insfail = 7;
		}
		else if (strlen($_GET['ipseudo']) > 15)
		{
			$insfail = 5;
		}
		//		else if (!preg_match("#^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$#", $_GET['imail']))
		//		{
		//			$insfail = 6;
		//		}
		else 
		{
			include ('../../functions/co_ins.php');
			$insfail = inscri($_GET['imail'], $_GET['ipseudo'], $_GET['ipasswd']);
			if ($insfail == -1)
			{
				unset($insfail);
				$res = 1;
			}
		}
	}
	else
		$insfail = 1;
}

/* --------------- --------------- --------------- Connection --------------- --------------- --------------- */

if (isset($_GET['submit']) && $_GET['submit'] == 'Connection')
{
	if (!empty($_GET['cpseudo']) && !empty($_GET['cpasswd']))
	{
		include ('../../functions/co_ins.php');
		$cofail = conect($_GET['cpseudo'], $_GET['cpasswd']);
		if ($cofail == 0)
		{
			unset ($cofail);
			header("location: ../../index.php");
		}
	}
	else
		$cofail = 1;

}

function ft_mail_password($mail, $cle)
{
	$sujet = "Activer votre compte";
	$entete = "From: shtheva@camagram.com";
	$message = "Bienvenue sur VotreSite,

		Hey nouveau mot de passe $cle, si c'est pas toi qui l'as demande, bah balek, nouveau mot de passe $cle.

	---------------
		Ceci est un mail automatique, Merci de ne pas y répondre.";
mail($mail, $sujet, $message, $entete);
}

function randomString($length = 8) {
	$str = "";
	$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
}

if (isset($_GET['submit']) && $_GET['submit'] == 'Forgot')
{
	if (!empty($_GET['cpseudo']))
	{
		include_once '/var/www/html/functions/bdco.php';
		$db = dataco();
		$newmdp = randomString();
		$getmail = $db->prepare('Select * FROM User WHERE pseudo = ?');
		$getmail->execute([$_GET['cpseudo']]);
		$user = $getmail->fetch(PDO::FETCH_ASSOC);
		$setmail = $db->prepare('UPDATE User SET mdp = ? WHERE pseudo = ?');
		$setmail->execute([hash('sha512', $newmdp), $_GET['cpseudo']]);
		ft_mail_password($user['mail'], $newmdp);
		$forgot = 0;
	}
	else
		$forgot = 1;
}
?>

<html>
	<head>
		<meta charset="utf-8">
		<title>Camagru</title>
		<link rel="stylesheet" href="connection.css">
		<link rel="stylesheet" href="../head_foot/header.css">
		<link rel="stylesheet" href="../head_foot/menu.css">
<script type="text/javascript">
var log='<?php if (isset($_SESSION['User'])) echo $_SESSION["User"];?>'
	</script>
		<script type="text/javascript"> var c='<?php if (isset($insfail) && $insfail != 0) {echo 0;} else {echo (1);}?>';</script>
	</head>
	<body>
		<?php include '../head_foot/header.php'; ?>	
	<script src="../head_foot/header.js"></script>
		<div id="menu">
			<button type="text" id="co">Connection</button>
			<button type="text" id="in">Inscription</button>
		</div>
		<?php /* --------------- --------------- --------------- Form pour inscription --------------- --------------- --------------- */ ?>
		<div id="inscription">
			<p id="intro">texte pour lefun fjhwevfhjewj fewjfbjewbf bfjqbfjb jkwebfk bewfkbewk bfkewbfjk fjkbewjkbf jkewbkjb ewjkfbejkwbf jkewbfjkbewjk bfewjkbf jkewbfjkbewjkfb jkewbfjkewbfjk bewjkfbjk ewbfjkb ewjkfb ejkwbfejkwbfjk bewfjkbewjkfb ejkwbfejkwbfjkewbfjkbewjkfbewjkbfjk bwefjk</p>
		<?php /* --------------- div pour inscription error --------------- */ ?>
			<div id="error">
<?php if (isset($res))
{echo $res;}?>
<?php if (isset($insfail) && $insfail == 1)
{echo "<p> Merci de remplir tout les champs</p>"; unset($insfail);}?>
<?php if (isset($insfail) && $insfail == 2)
{echo "<p> Mot de passe et mot de passe de confirmation sont differents... nidnsidnini sndi </p>"; unset($insfail);}?>
<?php if (isset($insfail) && $insfail == 3)
{echo "<p> Un compte a deja ete cree avec ce mail ...</p>"; unset($insfail);}?>
<?php if (isset($insfail) && $insfail == 4)
{echo "<p> Ce pseudo existe deja ...</p>"; unset($insfail);}?>
<?php if (isset($insfail) && $insfail == 5)
{echo "<p> Pseudo trop long (15 caracteres max) ...</p>"; unset($insfail);}?>
<?php if (isset($insfail) && $insfail == 6)
{echo "<p> Adresse mail invalide ...</p>"; unset($insfail);}?>
<?php if (isset($insfail) && $insfail == 7)
{echo "<p> Mot de passe non securise, 8caracteres min avec lettres + chiffres.</p>"; unset($insfail);}?>
			</div>
			<form  action:"connection.php" method:"GET">
				<label for="imail">Mail: </label>
				<input type="text" name="imail" value =<?php if (!empty($_GET['imail']) && isset($insfail)){ echo $_GET['imail'];}?>> <br>
				<label for="ipseudo">Pseudo: </label>
				<input type="text" name="ipseudo" value =<?php if (!empty($_GET['ipseudo']) && isset($insfail)){ echo $_GET['ipseudo'];}?>><br>
				<label for="ipasswd">Mot de passe: </label>
				<input type="password" name="ipasswd"><br>
				<label for="icopass">Confirmer mdp: </label>
				<input type="password" name="icopass"><br>
				<input  id="okey" type="submit" name="submit"  value="Ready to enter">
				<input  id="okey1" type="hidden" name="submit"  value="inscription">
			</form>
		</div>
		<?php /* --------------- --------------- --------------- Form pour connection --------------- --------------- --------------- */ ?>
		<div id="connection">
			<p id="intro">texte pour lefun fjhwevfhjewj fewjfbjewbf bfjqbfjb jkwebfk bewfkbewk bfkewbfjk fjkbewjkbf jkewbkjb ewjkfbejkwbf jkewbfjkbewjk bfewjkbf jkewbfjkbewjkfb jkewbfjkewbfjk bewjkfbjk ewbfjkb ewjkfb ejkwbfejkwbfjk bewfjkbewjkfb ejkwbfejkwbfjkewbfjkbewjkfbewjkbfjk bwefjk</p>
			<?php /* --------------- div pour connection error --------------- */ ?>
			<div id="error">
<?php if (isset($res) && $res == 1)
{echo "Vous venez de vous creer un compte, confirmez le mail avant de vous connecter ;)";
unset($res);}?>
<?php if (isset($cofail) && $cofail == 1)
{echo "<p> Merci de remplir tout les champs</p>";}?>
<?php if (isset($cofail) && $cofail == 2)
{echo "<p> Ce Pseudo n'existe pas ou n'as pas ete verifie...</p>"; unset($cofail);}?>
<?php if (isset($cofail) && $cofail == 3)
{echo "<p> Mot de passe / Pseudo non correspondant ...</p>"; unset($cofail);}?>
<?php if (isset($forgot) && $forgot == 1)
{echo "<p> Veuillez remplir le champs pseudo</p>"; unset($forgot);}?>
<?php if (isset($forgot) && $forgot == 0)
{echo "<p> Un nouveau mot de passe vous a ete envoye par mail</p>"; unset($forgot);}?>
			</div>
			<form  action:"connection.php" method:"GET">
				<label for="cpseudo">Pseudo: </label>
				<input type="text" name="cpseudo" value =<?php if (!empty($_GET['cpseudo'])){ echo $_GET['cpseudo'];}?>><br>
				<label for="cmdp">MDP: </label>
				<input type="password" name="cpasswd"<br>
				<input  id="okey3" type="submit" name="submit"  value="Connection">
				<input  id="okey3" type="submit" name="submit"  value="Forgot">
			</form>
		</div>
		<div id="acceuil">
<button type="text" id="retour">Retourner a l'acceuil</button>
		</div>
	</div>
		<?php include '../head_foot/footer.php'; ?>	
	<script src="connection.js"></script>
	</body>
</html>
