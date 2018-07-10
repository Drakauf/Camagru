<?php
session_start();
if (!(isset($_SESSION['User'])))
	echo "you must be connected";
print_r($_SESSION);
?>
