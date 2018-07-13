<?php
session_start();
include '/var/www/html/functions/bdco.php';
if (strlen($_POST['comment']) > 200)
	echo "toolong";
else
{
	$db = dataco();
	$addcom = $db->prepare('INSERT INTO Comlik (type, image_id, user_id, comment) VALUES ( "C", ?, ?, ?);');
	$addcom->execute([$_POST['id'], $_SESSION['User_id'], htmlspecialchars($_POST['comment'])]);
	echo "done";
}

?>
