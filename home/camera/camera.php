<?php
session_start();
if (!isset($_SESSION['User']))
	echo '<script type="text/javascript"> location.href = "/"; </script>';
else
{
	include_once './filtres.php';
}
?>
