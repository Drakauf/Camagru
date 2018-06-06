<?php

function dataco()
{
	include 'database.php';
	try {
		$connection = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e)
	{
		echo "Connection failed";
	}
	return ($connection);
}

$connection = dataco();

$user = "CREATE TABLE IF NOT EXISTS User (
	user_id INT NOT NULL AUTO_INCREMENT,
	mail	VARCHAR(100) NOT NULL,
	mdp		VARCHAR(1000) NOT NULL,
	pseudo	VARCHAR(15) DEFAULT NULL,
	comment INT	DEFAULT 1,
	PRIMARY KEY (user_id)
)";

$image = "CREATE TABLE IF NOT EXISTS Image (
	image_id	INT NOT NULL AUTO_INCREMENT,
	user_id		INT NOT NULL,
	date		DATE NOT NULL,
	PRIMARY KEY (image_id),
	FOREIGN KEY (user_id) REFERENCES User(user_id)
)";	

$comlik = "CREATE TABLE IF NOT EXISTS Comlik (
	comlik_id	INT NOT NULL AUTO_INCREMENT,
	type		VARCHAR(1) NOT NULL,
	comment		VARCHAR(200),
	image_id	INT NOT NULL,
	user_id		INT NOT NULL,
	PRIMARY KEY (comlik_id),
	FOREIGN KEY (image_id)	REFERENCES Image(image_id),
	FOREIGN KEY (user_id)	REFERENCES User(user_id)
)";

$connection->exec('CREATE DATABASE IF NOT EXISTS shanbase;
			USE shanbase;');
$connection->exec($user);
$connection->exec($image);
$connection->exec($comlik);

header("location: ../home/home.php");

?>
