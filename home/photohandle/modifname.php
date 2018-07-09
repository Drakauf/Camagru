<?php

if ($_POST['id'] == 'undefined')
		echo "prob";
else if ($_POST['name'] == 'undefined')
	echo "prob";
else
{
	if (strlen($_POST['name']) > 25)
		echo "toolong";
	else
	{
		include '/var/www/html/functions/bdco.php';
		$db = dataco();
		$chname = $db->prepare("UPDATE Image SET image_name = ? WHERE image_id = ?");
		if ($chname->execute([$_POST['name'], $_POST['id']]))
			echo "done";
		else
			echo "prob";
	}
}

?>
