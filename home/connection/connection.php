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

if (isset($_GET['submit']) && $_GET['submit'] == 'connection')
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

?>

<html>
	<head>
		<meta charset="utf-8">
		<title>Services Le-101</title>
		<link rel="stylesheet" href="connection.css">
		<script type="text/javascript"> var c='<?php if (isset($insfail) && $insfail != 0) {echo 0;} else {echo (1);}?>';</script>
	</head>
	<body>
	<div id="bigdiv">
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
				{echo "<p> Merci de remplir tout les champs</p>";}?>
				<?php if (isset($insfail) && $insfail == 2)
				{echo "<p> Mot de passe et mot de passe de confirmation sont differents... nidnsidnini sndi </p>";}?>
				<?php if (isset($insfail) && $insfail == 3)
				{echo "<p> Un compte a deja ete cree avec ce mail ...</p>";}?>
				<?php if (isset($insfail) && $insfail == 4)
				{echo "<p> Ce pseudo existe deja ...</p>";}?>
				<?php if (isset($insfail) && $insfail == 5)
				{echo "<p> Pseudo trop long (15 caracteres max) ...</p>";}?>
				<?php if (isset($insfail) && $insfail == 6)
				{echo "<p> Adresse mail invalide ...</p>";}?>
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
			</div>
			<form  action:"connection.php" method:"GET">
				<label for="cpseudo">Pseudo: </label>
				<input type="text" name="cpseudo" value =<?php if (!empty($_GET['cpseudo'])){ echo $_GET['cpseudo'];}?>><br>
				<label for="cmdp">MDP: </label>
				<input type="password" name="cpasswd"<br>
				<input  id="okey3" type="submit" name="submit"  value="Let's Fire the web !">
				<input  id="okey4" type="hidden" name="submit"  value="connection">
			</form>
		</div>
		<div id="acceuil">
<button type="text" id="retour">Retourner a l'acceuil</button>
		</div>
	</div>
	<script src="connection.js"></script>
	</body>
</html>
