<?php
session_start();
if (!(isset($_SESSION['User'])))
	echo '<script type="text/javascript"> location.href = "/home/connection/connection.php"; </script>';

include '/var/www/html/functions/bdco.php';
$db = dataco();

$bdimage = $db->prepare('SELECT * FROM Image WHERE image_id = ?');
$bdimage->execute([$_GET['id']]);
$image = $bdimage->fetch(PDO::FETCH_ASSOC);

if (!$image)
{
	header("Location: ../home.php");
}

$user = $db->prepare('SELECT * FROM User WHERE user_id = ?');
$user->execute([$image['user_id']]);
$username = $user->fetch(PDO::FETCH_ASSOC);

$likes = $db->prepare('SELECT * FROM Comlik WHERE image_id = ? AND type LIKE "L"');
$likes->execute([$_GET['id']]);
$nblikes = $likes->rowCount();

$comments = $db->prepare('SELECT * FROM Comlik WHERE image_id = ? AND type LIKE "C"');
$comments->execute([$_GET['id']]);
$nbcomments = $comments->rowCount();

$getcom = $db->prepare('SELECT * FROM Comlik WHERE type LIKE "C" AND image_id = ?');
$getcom->execute([$_GET['id']]);
?>

<html>
<head>
		<meta charset="utf-8" />
		<title>Camagru</title>
		<link rel="stylesheet" href="showphoto.css">
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

<div id="alldetails">
<?php echo '<div class="imgbody"><img class="image" id="'.$image['image_id'].'" src="data:image/png;base64,'.$image['image_src'].'" width="440" height="440"/><div id="usercarac"><div id="user_photo"><img src="data:image/png;base64,'.$username['user_ph'].'"/></div><h4 id=username>  '.$username['pseudo'].'</h4></div><div id=photocarac><h3>'.$image['image_name'].'</h3><p id="nbcomment">'. $nbcomments .'</p><img id=comimg src="/home/photohandle/comment.png"/><p id=likes> '. $nblikes .'</p><img id=likimg src=/></div></div>';?>
<div id=coms>
</div>
<div id=sendcom><textarea id="combox" name="comment"></textarea>
<input id="cbutton"  type="submit" name="sendcomment" value="Envoyer le commentaire"></div>
</div></div>
		<?php include '../head_foot/footer.php';?>
	<script src="../head_foot/menu.js"></script>
	<script src="showphoto.js"></script>
</body>
</html>
