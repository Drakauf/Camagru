<?php

if (isset($_GET['submit']) && $_GET['submit'] == "deconnection")
{
	session_destroy();
	echo '<script type="text/javascript"> location.href = "/"; </script>'; 
}

if (isset($_SESSION['User']))
	$user = $_SESSION['User'];
else 
	$user = "";
echo "<div id=bigdiv>
	<div id=header>
<div id=connected>
<div id=hname><h1>Bonjour $user </h1></div>
<form id=formulaire action:'home.php' method:'GET'>
<input id=deco type=submit value=deconnection name=submit>
</form>
</div>
<div id=noconnect>
<p> Bonjour Invite</p>
<button id=cobutton>Connection | Inscription</button>
</div>
</div>";
?>
