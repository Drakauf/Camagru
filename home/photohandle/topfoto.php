<?php
session_start();
if (!(isset($_SESSION['User'])))
	echo '<script type="text/javascript"> location.href = "/"; </script>';

include '/var/www/html/functions/bdco.php';
$toshow = array();
$db = dataco();
$select = $db->prepare('SELECT * FROM Image');
$select->execute();
$allphotos = $select->fetchAll(PDO::FETCH_ASSOC);

foreach ($allphotos as $photo)
{
	$getlikes = $db->prepare('SELECT * FROM Comlik WHERE type = "L" and image_id = ?');
	$getlikes->execute([$photo['image_id']]);
	$alllikes = $getlikes->fetchAll(PDO::FETCH_ASSOC);
	$toshow[$photo['image_id']] = $getlikes->rowCount();
}
arsort($toshow);
$thephotos=(array_slice(array_keys($toshow),0,10));
?>

<html>
	<head>
		<meta charset="utf-8" />
		<title> Camagru </title>
		<link rel="stylesheet" href="../head_foot/header.css">
		<link rel="stylesheet" href="../head_foot/menu.css">
		<link rel="stylesheet" href="topfoto.css">
		<script type="text/javascript">
		var log='<?php echo $_SESSION['User'] ?>'
		</script>
	</head>

	<body>
	<?php include_once '../head_foot/header.php'?>
<div id="body">
	<?php include_once '../head_foot/menu.php'?>
	<div id="slidebody">
	<div id="theslides">
<?php foreach ($thephotos as $like)
{
	$getphoto= $db->prepare('SELECT * FROM Image WHERE image_id = ?');
	$getphoto->execute([$like]);
	$photo = $getphoto->fetch(PDO::FETCH_ASSOC);
	echo '<img class="mySlides" src="data:image/png;base64,'.$photo['image_src'].'">';
}?></div>
</div>
</div>
	<?php include_once '../head_foot/footer.php'?>
<script src="../head_foot/header.js"></script>
	<script src="../head_foot/menu.js"></script>
	<script src="topfoto.js"></script>
</body>
</html>

