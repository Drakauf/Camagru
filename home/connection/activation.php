<?php
if (!(isset ($_GET['log'], $_GET['cle'])))
	echo "ERROR you shouldn't be here";
else
	{
		include '/var/www/html/functions/bdco.php';
		$db = dataco();
		$sqlcheck = $db->prepare('SELECT * FROM User WHERE pseudo LIKE ? AND active LIKE 0');
		$sqlcheck->execute([$_GET['log']]);
		if ($sqlcheck->rowCount() === 0)
			echo ("Ce compte n'existe pas ou a deja ete active");
		else
		{
			echo "here";
			$sqlinsert = $db->prepare('UPDATE User SET active = 1 WHERE pseudo LIKE ?');
		$sqlinsert->execute([$_GET['log']]);
		}
}
?>
