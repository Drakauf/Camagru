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
	<script type="text/javascript">
		var log='<?php echo $loggued;?>'
	</script>
</head>
	<body>
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
		<script src="home.js"></script>
	</body>
</html>
