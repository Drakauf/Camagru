<?php
session_start();
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
			<div id="reglette">
				<input id="taille" type="range" min="300" max="500" value="300" name="slider"/>
			</div>
<?php /* --------------- --------------- --------------- Images / Menu --------------- --------------- --------------- */ ?>
			<div id="body">
		<?php include 'head_foot/menu.php'; ?>
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
	<script src="head_foot/menu.js"></script>
	<script src="head_foot/header.js"></script>
	</body>
</html>
