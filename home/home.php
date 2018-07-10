<?php
session_start();
$loggued = (isset($_SESSION['User'])) ? $_SESSION['User']:'';
if (isset($_GET['submit']) && $_GET['submit'] == "deconnection")
{
	session_destroy();
	header("location: home.php");
}
?>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Camagru</title>
		<link rel="stylesheet" href="home.css">
		<script type="text/javascript">
			var log='<?php echo $loggued;?>'
		</script>
	</head>
	<body>
		<?php include 'head_foot/header.php'; ?>
			<div id="reglette">
				<input id="taille" type="range" min="300" max="500" value="300" name="slider"/>
			</div>
<?php /* --------------- --------------- --------------- Images / Menu --------------- --------------- --------------- */ ?>
			<div id="body">
<?php /* --------------- Menu --------------- */ ?>
				<div id="comenu">
					<h1 align="center">Menu</h1>
					<button type="text" id="acceuil">Acceuil</button></br></br>
					<button type="text" id="camera">Prendre une photo</button></br></br>
					<button type="text" id="myphotos">Mes Photos</button></br></br>
					<button type="text" id="settings">Mes Reglages</button>
				</div>
<?php /* --------------- Images --------------- */ ?>
			<div id="imgdisplay">
			<div class="imgbody"> 
				<img class="image" src="http://google.com/images/logo.png"/>
<p>text</p>
			</div>
		</div>
		</div>
	</div>
	<?php include 'head_foot/footer.php'; ?>
	<script src="home.js"></script>
	</body>
</html>
