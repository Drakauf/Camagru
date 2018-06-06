<?php
if (isset($_GET['submit']) && $_GET['submit'] == 'OK')
{
	if (!empty($_GET['f_name']) && !empty($_GET['l_name']) && !empty($_GET['phone']) && !empty($_GET['mail']) && !empty($_GET['passwd']))
	{
		$insfail = 0;
	}
	else
	{
		$insfail = 1;
		$c = 0;
	}
}
?>

<html>
	<head>
		<meta charset="utf-8">
		<title>Services Le-101</title>
		<link rel="stylesheet" href="connection.css">
		<script type="text/javascript"> var c='<?php if (isset($insfail) && $insfail == 1) {echo 0;} else {echo (1);}?>';
		alert (c);</script>
	</head>
	<body>
	<div id="bigdiv">
		<div id="menu">
			<button type="text" id="co">Connection</button>
			<button type="text" id="in">Inscription</button>
		</div>
		<div id="inscription">
			<p id="intro">texte pour lefun fjhwevfhjewj fewjfbjewbf bfjqbfjb jkwebfk bewfkbewk bfkewbfjk fjkbewjkbf jkewbkjb ewjkfbejkwbf jkewbfjkbewjk bfewjkbf jkewbfjkbewjkfb jkewbfjkewbfjk bewjkfbjk ewbfjkb ewjkfb ejkwbfejkwbfjk bewfjkbewjkfb ejkwbfejkwbfjkewbfjkbewjkfbewjkbfjk bwefjk</p>
			<form  action:"connectuser.php" method:"GET">
				<?php if (isset($fail) && $fail == 1)
				{echo "<p> Merci de remplir tout les champs</p>";}?>
				<label for="mail">Mail: </label>
				<input type="Text" name="mail" value =<?php if (!empty($_GET['mail'])){ echo $_GET['mail'];}?>> <br>
				<label for="pseudo">Pseudo: </label>
				<input type="Text" name="pseudo" value =<?php if (!empty($_GET['pseudo'])){ echo $_GET['pseudo'];}?>><br>
				<label for="mdp">MDP: </label>
				<input type="Text" name="passwd" value =<?php if (!empty($_GET['passwd'])){ echo $_GET['passwd'];}?>><br>
				<input  id="formsize" type="submit" name="submit"  value="OK">
			</form>
		</div>
		<div id="acceuil">
<p>pdsdsdsdsaadeeeeeeeefffffs</p>
		</div>
	</div>
	<script src="connection.js"></script>
	</body>
</html>
