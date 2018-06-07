<?php

function dataco()
{
	include '/var/www/html/config/database.php';
	try {
		$connection = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e)
	{
		echo "Connection failed";
	}
	$connection->exec('CREATE DATABASE IF NOT EXISTS shanbase;
				USE shanbase;');
	return ($connection);
}

?>
