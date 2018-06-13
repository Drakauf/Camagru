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
	<div id="bigdiv">
		<div id="header">
			<div id="connected">
				<p>Bonjour <?php echo $_SESSION['User'];?><br>
				<form action:"home.php" method:"GET">
					<input id="deco" type="submit" value="deconnection" name="submit">
				</form>
			</div>
			<div id="noconnect">
				<p> Bonjour Invite</p>
				<button id="cobutton">Connection | Inscription</button>
			</div>
		</div>
		<div id="reglette">
			<input id="taille" type="range" min="300" max="500" value="300" name="slider"/>
		</div>
		<div id="body">

<div id="comenu">
			<h1 align="center">Menu</h1>
		</div>

		<div id="imgdisplay">
<div class="imgbody">
				<img class="image" src="http://google.com/images/logo.png"/>
<p>text</p>
			</div>
			<div class="imgbody"> 
				<img class="image" src="http://google.com/images/logo.png"/>
<p>text</p>
			</div>
	<div class="imgbody">
				<img class="image" src="http://google.com/images/logo.png"/>
<p>text</p>
			</div>
			<div class="imgbody"> 
				<img class="image" src="http://google.com/images/logo.png"/>
<p>text</p>
			</div>
			<div class="imgbody">
				<img class="image" src="http://google.com/images/logo.png"/>
<p>text</p>
			</div>
			<div class="imgbody"> 
				<img class="image" src="http://google.com/images/logo.png"/>
<p>text</p>
			</div>
	<div class="imgbody">
				<img class="image" src="http://google.com/images/logo.png"/>
<p>text</p>
			</div>
			<div class="imgbody"> 
				<img class="image" src="http://google.com/images/logo.png"/>
<p>text</p>
			</div>
	<div class="imgbody">
				<img class="image" src="http://google.com/images/logo.png"/>
<p>text</p>
			</div>
			<div class="imgbody"> 
				<img class="image" src="http://google.com/images/logo.png"/>
<p>text</p>
			</div>
	<div class="imgbody">
				<img class="image" src="http://google.com/images/logo.png"/>
<p>text</p>
			</div>
			<div class="imgbody"> 
				<img class="image" src="http://google.com/images/logo.png"/>
<p>text</p>
			</div>
			<div class="imgbody">
				<img class="image" src="http://google.com/images/logo.png"/>
<p>text</p>
			</div>
			<div class="imgbody"> 
				<img class="image" src="http://google.com/images/logo.png"/>
<p>text</p>
			</div>
	<div class="imgbody">
				<img class="image" src="http://google.com/images/logo.png"/>
<p>text</p>
			</div>
			<div class="imgbody"> 
				<img class="image" src="http://google.com/images/logo.png"/>
<p>text</p>
			</div>
		</div>
		</div>
	</div>
	<script src="home.js"></script>
	</body>
</html>
