<?php

/* --------------- --------------- --------------- Form pour inscription --------------- --------------- --------------- */

if (isset($_GET['submit']) && $_GET['submit'] == 'inscription')
{
	if (!empty($_GET['ipseudo']) && !empty($_GET['imail']) && !empty($_GET['ipasswd']))
	{
		if (isset($insfail))
			unset($insfail);
	}
	else
	{
		$insfail = 1;
		$c = 0;
	}
}

/* --------------- --------------- --------------- Form pour connection --------------- --------------- --------------- */

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
			<form  action:"connection.php" method:"GET">
				<?php if (isset($insfail) && $insfail == 1)
				{echo "<p> Merci de remplir tout les champs</p>";}?>
				<label for="imail">Mail: </label>
				<input type="text" name="imail" value =<?php if (!empty($_GET['mail'])){ echo $_GET['mail'];}?>> <br>
				<label for="ipseudo">Pseudo: </label>
				<input type="text" name="ipseudo" value =<?php if (!empty($_GET['pseudo'])){ echo $_GET['pseudo'];}?>><br>
				<label for="imdp">MDP: </label>
				<input type="password" name="ipasswd"<br>
				<input  id="okey" type="submit" name="submit"  value="Ready to enter">
				<input  id="okey" type="hidden" name="submit"  value="inscription">
			</form>
		</div>
		<?php /* --------------- --------------- --------------- Form pour connection --------------- --------------- --------------- */ ?>
		<div id="connection">
			<p id="intro">texte pour lefun fjhwevfhjewj fewjfbjewbf bfjqbfjb jkwebfk bewfkbewk bfkewbfjk fjkbewjkbf jkewbkjb ewjkfbejkwbf jkewbfjkbewjk bfewjkbf jkewbfjkbewjkfb jkewbfjkewbfjk bewjkfbjk ewbfjkb ewjkfb ejkwbfejkwbfjk bewfjkbewjkfb ejkwbfejkwbfjkewbfjkbewjkfbewjkbfjk bwefjk</p>
			<form  action:"connection.php" method:"GET">
				<label for="cpseudo">Pseudo: </label>
				<input type="text" name="cpseudo" value =<?php if (!empty($_GET['cpseudo'])){ echo $_GET['cpseudo'];}?>><br>
				<label for="cpasswd">MDP: </label>
				<input type="password" name="cpasswd"><br>
				<input  id="okey" type="submit" name="submit"  value="Let's Fire the web !">
				<input  id="okey" type="hidden" name="submit"  value="OK">
			</form>
		</div>
		<div id="acceuil">
<button type="text" id="retour">Retourner a l'acceuil</button>
		</div>
	</div>
	<script src="connection.js"></script>
	</body>
</html>
