<?php
//session_start();
$loggued = (isset($_SESSION['User'])) ? $_SESSION['User']:'';
?>
<html>
<head>
	<script type="text/javascript">
		var log='<?php echo $loggued;?>'
	</script>
</head>
	<body>
		<div id="connected">
		<p>Bonjour <?php echo $_SESSION['User'];?>
		</div>
		<div id="noconnect">
			<p> Bonjour Invite</p>
			<button id="cobutton">Connection | Inscription</button>
		</div>
		<script src="home.js"></script>
	</body>
</html>
