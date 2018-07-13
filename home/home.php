<?php
session_start();
include '/var/www/html/functions/bdco.php';
$db = dataco();

$bdimage = $db->prepare('SELECT * FROM Image ORDER BY image_id DESC');
$bdimage->execute();
$imagestab = $bdimage->fetchAll(PDO::FETCH_ASSOC);

?>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Camagru</title>
		<link rel="stylesheet" href="home.css">
		<link rel="stylesheet" href="head_foot/menu.css">
		<link rel="stylesheet" href="head_foot/header.css">
		<script type="text/javascript">
			var log='<?php if (isset($_SESSION['User'])) echo $_SESSION["User"];?>'
		</script>
	</head>
	<body>
		<?php include 'head_foot/header.php'; ?>
	<script src="head_foot/header.js"></script>
			<div id="reglette">
				<input id="taille" type="range" min="255" max="650" value="440" name="slider"/>
			</div>
<?php /* --------------- --------------- --------------- Images / Menu --------------- --------------- --------------- */ ?>
			<div id="body">
		<?php include 'head_foot/menu.php'; ?>
	<script src="home.js"></script>
<div id=imgdisplay>
<?php
if (count($imagestab) == 0)
		echo "<h1>There is no image yet, be the first to post one =D</h1>";
foreach ($imagestab as $images)
{
	$user = $db->prepare('SELECT * FROM User WHERE user_id = ?');
	$user->execute([$images['user_id']]);
	$username = $user->fetch(PDO::FETCH_ASSOC);
		echo '<div class="imgbody"><img class="image" id="'.$images['image_id'].'" src="data:image/png;base64,'.$images['image_src'].'" width="440" height="440"/><div id="usercarac"><div id="user_photo"><img src="data:image/png;base64,'.$username['user_ph'].'"/></div><h4 id=username>  '.$username['pseudo'].'</h4></div><div id=photocarac><h3>'.$images['image_name'].'</h3><p>1</p><p>likes</p></div></div>';
}
?>
		</div>
	</div>
</div>
	<?php include 'head_foot/footer.php'; ?>
	<script src="head_foot/menu.js"></script>
	<script src="photoevent.js"></script>
	</body>
</html>
