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
	$save->execute([$mail, $passwd, $pseudo]);
	return (-1);
}
