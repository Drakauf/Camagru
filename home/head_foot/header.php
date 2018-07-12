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
<div id=hname><h1>Bonjour $user </h1></div>";
echo '<img id=deco src="/home/head_foot/deco.png">
</div>
<div id=noconnect>
<div id=hname><h1> Bonjour Invite</h1></div>
<button id=cobutton>Connection | Inscription</button>
</div>
</div>';
?>
