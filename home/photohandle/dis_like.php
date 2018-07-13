<?php
session_start();
if (isset($_POST['id']))
{
	include '/var/www/html/functions/bdco.php';
	$db = dataco();

	$status = $db->prepare('SELECT * FROM Comlik WHERE type LIKE "L" AND image_id = ? AND user_id = ?');
	$status->execute([$_POST['id'], $_SESSION['User_id']]);
	if ($status->rowCount() == 0)
		echo "not liked";
	else
		echo "liked";
}

if (isset($_POST['like']))
{
	include '/var/www/html/functions/bdco.php';
	$db = dataco();

	$status = $db->prepare('SELECT * FROM Comlik WHERE type LIKE "L" AND image_id = ? AND user_id = ?');
	$status->execute([$_POST['like'], $_SESSION['User_id']]);
	if ($status->rowCount() == 0)
	{
		$addlike = $db->prepare('INSERT INTO Comlik (type, image_id, user_id) VALUES ( "L" , ?, ?);');
		$addlike->execute([$_POST['like'], $_SESSION['User_id']]);
		echo "like";
	}
	else
	{
		$dellike = $db->prepare('DELETE FROM Comlik WHERE type LIKE "L" AND image_id = ? AND user_id = ?;');
		$dellike->execute([$_POST['like'], $_SESSION['User_id']]);
		echo "dislike";
	}
}
