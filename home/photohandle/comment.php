<?php
session_start();
include '/var/www/html/functions/bdco.php';

if (isset($_POST['comment']))
{
	if (strlen($_POST['comment']) == 0)
		echo "tooshort";
	else if (strlen($_POST['comment']) > 200)
		echo "toolong";
	else
	{
		$db = dataco();
		$addcom = $db->prepare('INSERT INTO Comlik (type, image_id, user_id, comment) VALUES ( "C", ?, ?, ?);');
		$addcom->execute([$_POST['id'], $_SESSION['User_id'], htmlspecialchars($_POST['comment'])]);
		$getcom = $db->prepare('SELECT * FROM Comlik WHERE type LIKE "C" AND image_id = ?');
	$getcom->execute([$_POST['id']]);

	if ($getcom->rowCount())
	{
		$allcoms = $getcom->fetchAll(PDO::FETCH_ASSOC);
		foreach ($allcoms as $com)
		{

			print_r($com);
		};	
	}
	else 
		echo "";

	}
}
else
{
	$db = dataco();
	$getcom = $db->prepare('SELECT * FROM Comlik WHERE type LIKE "C" AND image_id = ?');
	$getcom->execute([$_POST['id']]);

	if ($getcom->rowCount())
	{
		$allcoms = $getcom->fetchAll(PDO::FETCH_ASSOC);
		foreach ($allcoms as $com)
		{

			print_r($com);
		};	
	}
	else 
		echo "";
}
?>
