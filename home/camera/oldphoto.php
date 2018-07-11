<?php
session_start();
include '/var/www/html/functions/bdco.php';
$db = dataco();
$histor = $db->prepare('SELECT * FROM Image WHERE user_id = ? ORDER BY image_id DESC');
$histor->execute([$_SESSION['User_id']]);
if ($histor->rowCount())
{
		$oldphoto = $histor->fetchAll(PDO::FETCH_ASSOC);
}
else
		$oldphoto = 0;
if ($oldphoto == 0) echo "<h1>You have no photos yet, take some and show off ;)</h1>";
else
{
	foreach ($oldphoto as $photo)
	{
		$img = "data:image/png;base64,".$photo['image_src'];
		echo "<img class=oldphoto src=$img>";
	};
}?>
