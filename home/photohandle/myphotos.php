<?php
session_start();
include '/var/www/html/functions/bdco.php';
$db = dataco();

$bdimage = $db->prepare('SELECT * FROM Image WHERE User_id = ?');
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
</head>
<body>
<div id="allphotos">
<?php
if (count($imagestab) == 0)
	echo "you have no images yet";
foreach ($imagestab as $images)
{
	echo '<div id="img_name" class="modif"><div id="imgdiv"><img class="image" id="'.$images['image_id'].'" src="data:image/png;base64,'.$images['image_src'].'"/></div><input type="text" class="imgname" value="'.$images['image_name'].'"><button class="cname"> change name</button></br></br><button class="bouton">Delete photo</button> </div>';
}
?>
</div>
	<script src="myphotos.js"></script>
</body>
</html>
