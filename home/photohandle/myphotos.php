<?php
session_start();
include '/var/www/html/functions/bdco.php';
$db = dataco();

$bdimage = $db->prepare('SELECT * FROM Image WHERE User_id = ? ORDER BY image_id DESC');
$bdimage->execute([$_SESSION['User_id']]);
$imagestab = $bdimage->fetchAll(PDO::FETCH_ASSOC);

function mpsredirect($id)
{
	header('Location: modifimage.php?id='.$id);
}
?>
<html>
<head>
		<meta charset="utf-8" />
		<title>Camagru</title>
		<link rel="stylesheet" href="myphotos.css">
		<link rel="stylesheet" href="../head_foot/header.css">
		<link rel="stylesheet" href="../head_foot/menu.css">
<script type="text/javascript">
var log='<?php if (isset($_SESSION['User'])) echo $_SESSION["User"];?>'
	</script>
</head>
<body>
		<?php include '../head_foot/header.php'; ?>
	<script src="../head_foot/header.js"></script>
<div id= "body">		
<?php include '../head_foot/menu.php'; ?>
<div id="allphotos">
<?php
if (count($imagestab) == 0)
		echo "you have no images yet";
foreach ($imagestab as $images)
{
		echo '<div id="img_name" class="modif"><div id="imgdiv"><img class="image" id="'.$images['image_id'].'" src="data:image/png;base64,'.$images['image_src'].'"/></div><div id="rename"><input type="text" class="imgname" value="'.$images['image_name'].'"><img class=cname src="pencil.jpg"></div><img class="suppr" src="bin.png"></div>';
}?>
</div>
</div>
		<?php include '../head_foot/footer.php'; ?>
	<script src="../head_foot/menu.js"></script>
	<script src="myphotos.js"></script>
</body>
</html>
