<?php

include '/var/www/html/functions/bdco.php';
$dossier = './filtres/';
$files = array_diff(scandir($dossier), array('..', '.','.DS_Store', 'filtres.php', '.filtres.php.swp', 'filtres.css', '.filtres.css.swp', 'filtres.js', '.filtres.js.swp'));

$db = dataco();
$sqlcheck = $db->prepare('SELECT * FROM Filters');
$sqlcheck->execute();
$sqlinser = $db->prepare('INSERT INTO Filters (name, path) VALUES(?, ?);');
if (!($sqlcheck->rowCount()))
{
	foreach($files as $fichiers)
	{
		$split = preg_split('/.png/', $fichiers);
		$name = $split['0'];	
		$image = './filtres/'.$fichiers;
		$sqlinser->execute([$name, $image]);
	}
}
$sqlcheck->execute();
if ($sqlcheck->rowCount())
{
	$filtres = $sqlcheck->fetchAll(PDO::FETCH_ASSOC);
	foreach ($filtres as $filter)
	{
		$img = $filter['path'];
	}
}
?>
<html>
<head>
		<meta charset="utf-8" />
		<title>Camagru</title>
		<link rel="stylesheet" href="camera.css">
	</head>
	<body>
<div id="camera">
		<?php foreach ($filtres as $filter)
{
	$img_p = $filter['path'];
	$img_n = $filter['name'];
	echo "<img src=$img_p alt=$img_n class='toshow'>";
}?>

<video id="video"></video>
		</div>
		<div id="filtres">
	<?php foreach ($filtres as $filter)
{
	$img_p = $filter['path'];
	$img_n = $filter['name'];
	echo "<img src=$img_p alt=$img_n class='filtre'>";
}?>
		</div>
 <button id="startbutton">Prendre une photo</button>
<canvas id="canvas"></canvas>
<img src="http://placekitten.com/g/320/261" id="photo" alt="photo">


	<script src="filtres.js"></script>
	<script src="camera.js"></script>
	</body>
</html>
