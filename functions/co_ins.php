<?php

include '/var/www/html/functions/bdco.php';

function random_pic()
{
		$files = glob(realpath('/var/www/html/functions/icons') . '/*.*');
		$file = array_rand($files);
		return $files[$file];
}

function inscri($mail, $pseudo, $pass){
	$db = dataco();

	$sqlmail = $db->prepare('SELECT * FROM User WHERE pseudo LIKE ?');
	$sqlmail->execute([htmlspecialchars($pseudo)]);
	$res = $sqlmail->rowCount();
	if ($res != 0)
		return (4);
	
	$sqlmail = $db->prepare('SELECT * FROM User WHERE mail LIKE ?');
	$sqlmail->execute([$mail]);
	$res = $sqlmail->rowCount();
	if ($res != 0)
		return (3);

	$icon = base64_encode(file_get_contents(random_pic()));
	$cle = md5(microtime(TRUE)*10);
	$passwd = hash('sha512', $pass);
	$save = $db->prepare('INSERT INTO User (mail, mdp, pseudo, cle, user_ph) VALUES( ?, ?, ?, ?, ?);');
	$save->execute([$mail, $passwd, htmlspecialchars($pseudo), $cle, $icon]);
	ft_mail($mail, $pseudo, $cle);
	return (-1);
}


function ft_mail($mail, $pseudo, $cle)
{
	$sujet = "Activer votre compte";
	$entete = "From: shtheva@camagram.com";
	$message = "Bienvenue sur VotreSite,
		 
		Pour activer votre compte, veuillez cliquer sur le lien ci dessous
		ou copier/coller dans votre navigateur internet.
		 
		http://localhost:8008/home/connection/activation.php?log=$pseudo&cle=$cle
 
	---------------
		Ceci est un mail automatique, Merci de ne pas y répondre.";
	mail($mail, $sujet, $message, $entete);
}

function conect($pseudo, $pass){
	$db = dataco();
	$sqlsearch = $db->prepare('SELECT * FROM User WHERE pseudo LIKE ? AND active LIKE 1');
	$sqlsearch->execute([$pseudo]);
	$res = $sqlsearch->rowCount();
	if ($res == 0)
		return 2;
	$passwd = hash('sha512', $pass);
	$sqlsearch = $db->prepare('SELECT * FROM User WHERE pseudo LIKE ? AND mdp LIKE ?');
	$sqlsearch->execute([$pseudo, $passwd]);
	$res = $sqlsearch->rowcount();
	if ($res == 0)
		return (3);
	$result = $sqlsearch->fetch(PDO::FETCH_ASSOC);
	session_start();
	$_SESSION['User'] = $result['pseudo'];
	$_SESSION['User_id'] = $result['user_id'];
	$cofail = 0;
}
?>
