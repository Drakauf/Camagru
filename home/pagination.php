<?php
session_start();
include '/var/www/html/functions/bdco.php';
$db = dataco();

$bdimage = $db->prepare('SELECT * FROM Image WHERE image_id < ? ORDER BY image_id DESC LIMIT 5');
$bdimage->execute([$_POST['id']]);
$imagestab = $bdimage->fetchAll(PDO::FETCH_ASSOC);

if (count($imagestab) == 0)
	echo "nomore";
else
{
	foreach ($imagestab as $images)
{
		$user = $db->prepare('SELECT * FROM User WHERE user_id = ?');
			$user->execute([$images['user_id']]);
			$username = $user->fetch(PDO::FETCH_ASSOC);

			$likes = $db->prepare('SELECT * FROM Comlik WHERE image_id = ? AND type LIKE "L"');
			$likes->execute([$images['image_id']]);
			$nblikes = $likes->rowCount();

			$comments = $db->prepare('SELECT * FROM Comlik WHERE image_id = ? AND type LIKE "C"');
			$comments->execute([$images['image_id']]);
			$nbcomments = $comments->rowCount();



			echo '<div class="imgbody"><img class="image" id="'.$images['image_id'].'" src="data:image/png;base64,'.$images['image_src'].'" width="440" height="440"/><div id="usercarac"><div id="user_photo"><img src="data:image/png;base64,'.$username['user_ph'].'"/></div><h4 id=username>  '.$username['pseudo'].'</h4></div><div id=photocarac><h3>'.$images['image_name'].'</h3><p id=nbcomment>'.$nbcomments.'</p><img id=coming src="/home/photohandle/comment.png"><p class=likes>'.$nblikes.'</p><img class=likimg src=/></div></div>';
}}
?>
