<?php
session_start();
if (!isset($_SESSION['User']))
	echo "you should not be here";
else
{
	include_once './filtres.php';
}
?>
