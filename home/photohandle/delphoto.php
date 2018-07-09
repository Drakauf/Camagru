<?php
if ($_POST['id'] == 'undefined')
	echo "nophoto";
else
{
	include '/var/www/html/functions/bdco.php';
	$db = dataco();
	$delphoto = $db->prepare("DELETE FROM Image WHERE image_id = ?");
	$delphoto->execute([$_POST['id']]);
	echo "done";
}
?>
