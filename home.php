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
		<script>
		var codiv = document.getElementById("connected");
		var nocodiv = document.getElementById("noconnect");
		if (log)
		{
			codiv.style.display = "block";
			nocodiv.style.display = "none";
		}
		else
		{
			codiv.style.display = "none";
			nocodiv.style.display = "block";
		}
		var cobutton = document.getElementById("cobutton");
		cobutton.addEventListener("click", coredirect);
		function coredirect()
		{
			location.href = "inscription.php";
		}
</script>
	</body>
</html>
