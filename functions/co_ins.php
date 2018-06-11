<?php

include '/var/www/html/functions/bdco.php';

function inscri($mail, $pseudo, $pass){
	$db = dataco();
	$sqlmail = $db->prepare('SELECT * FROM User WHERE mail LIKE ?');
	$sqlmail->execute([$mail]);
	$res = $sqlmail->rowCount();
	if ($res != 0)
		return (3);
	$sqlmail = $db->prepare('SELECT * FROM User WHERE mail LIKE ?');
	$sqlmail->execute([$pseudo]);
	$res = $sqlmail->rowCount();
	if ($res != 0)
		return (4);
	$passwd = hash('sha512', $pass);
	$save = $db->prepare('INSERT INTO User (mail, mdp, pseudo) VALUES( ?, ?, ?);');
	$save->execute([$mail, $passwd, htmlspecialchars($pseudo)]);
	return (-1);
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
