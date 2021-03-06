<?php

include '/var/www/html/functions/bdco.php';

$connection = dataco();

$user = "CREATE TABLE IF NOT EXISTS User (
	user_id INT NOT NULL AUTO_INCREMENT,
	mail	VARCHAR(1000) NOT NULL,
	user_ph	VARCHAR(1200000),
	mdp		VARCHAR(1000) NOT NULL,
	pseudo	VARCHAR(15) DEFAULT NULL,
	cle		VARCHAR(100000)	NOT NULL,
	notif	INT DEFAULT 1,
	active	INT DEFAULT 0,
	PRIMARY KEY (user_id)
)";

$image = "CREATE TABLE IF NOT EXISTS Image (
	image_id	INT NOT NULL AUTO_INCREMENT,
	image_src	VARCHAR(1200000),
	image_name	VARCHAR(25),
	user_id		INT NOT NULL,
	date		VARCHAR(50),
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

$filter = "CREATE TABLE IF NOT EXISTS Filters (
	filter_id	INT NOT NULL AUTO_INCREMENT,
	name		VARCHAR(10000000),
	path		VARCHAR(10000000),
	PRIMARY KEY (filter_id)
	)";
	
$connection->exec('CREATE DATABASE IF NOT EXISTS shanbase;
			USE shanbase;');
$connection->exec($user);
$connection->exec($image);
$connection->exec($comlik);
$connection->exec($filter);

header("location: ../home/home.php");

?>
