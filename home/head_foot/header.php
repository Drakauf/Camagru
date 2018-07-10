<?php
if (isset($_SESSION['User']))
	$user = $_SESSION['User'];
else 
	$user = "";
echo "<div id=bigdiv>
	<div id=header>
<div id=connected>
<p>Bonjour $user <br>
<form action:'home.php' method:'GET'>
<input id=deco type=submit value=deconnection name=submit>
</form>
</div>
<div id=noconnect>
<p> Bonjour Invite</p>
<button id=cobutton>Connection | Inscription</button>
</div>
</div>";
?>
