<?php
session_start();

if ($_POST['filtre'] == 'undefined')
	echo "nofiltre";
else if ($_POST['data'] == 'undefined')
	echo "nodata";
else if ($_POST['data'] != 'undefined' && $_POST['filtre'] != 'undefined')
{
	//	$data = base64_decode($_POST['data']);

	$filarray=explode("/", $_POST['filtre']);

	$fil = file_get_contents("filtres/".$filarray[6]);
	$src = imagecreatefromstring($fil);
	
	$upload_dir = "filtres/";
	$img = $_POST['data'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	$file = $upload_dir . time() . ".png";
	$dest = imagecreatefromstring($data);
	
///////////////	
	$dest_image = imagecreatetruecolor(680, 480);
	imagesavealpha($dest_image, true);
	$trans_background = imagecolorallocatealpha($dest_image, 0, 0, 0, 127);
	imagefill($dest_image, 0, 0, $trans_background);

	imagecopy($dest_image, $dest, 0, 0, 0, 0, 680, 480);
	imagecopy($dest_image, $src, 0, 0, 0, 0, 680, 480);
	
////////

	ob_start();
	imagepng($dest_image);
	$image = ob_get_contents();
	ob_end_clean();
	$imgbase = base64_encode($image);

	include '/var/www/html/functions/bdco.php';
	$db = dataco();
	$insertp = $db->prepare('INSERT INTO Image (image_src, image_name, user_id, date) VALUES( ?, ?, ?, ?);');
	$insertp->execute([$imgbase, date('d.m.y', time()), $_SESSION['User_id'], date(time())]);
echo "<script> console.log($dest)</script>";
}
?>
