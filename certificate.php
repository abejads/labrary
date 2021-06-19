<?php
	session_start();
	if(!isset($_SESSION["uid"])){
	    header("Location: index.php");
	    die();
	}

	$id = $_GET['certID'];
	require_once("include/connection.php");

	if(isset($id) && $id != ""){
		$doQuery = $conn->prepare("SELECT * FROM certificates JOIN users ON certificates.userID = users.id JOIN courses ON certificates.courseID = courses.courseID WHERE certificates.certID = ?");

		if($doQuery->bind_param("s", $id) && $doQuery->execute()){
			$result = $doQuery->get_result();
			if($result->num_rows > 0){
				$cert = $result->fetch_assoc();

				$name = explode(" ", $cert['name']);
				$courseName = $cert['courseName'];

			} else {
				echo '<script>alert("Certificate not found!");  window.location = "account.php"; </script>';
				die();
			}

		} else {
			echo '<script>alert("Error!")</script>';
			die();
		}

	} else {
		echo '<script>alert("Certificate not found!");  window.location = "account.php"; </script>';
		die();
	}

	header("Content-type: image/png");
	$font = realpath('generate-certs/Kollektif-Bold.ttf');
	$image = imagecreatefrompng('generate-certs/cert.png');
	$color = imagecolorallocate($image, 51, 51, 102);
	if (count($name) <= 1){
		$name0 = $name[0];
		imagettftext($image, 50, 0, 79, 370, $color, $font, $name0);
	} else if (count($name) >= 2){
		$name1 = $name[0]. " " .$name[1];
		imagettftext($image, 50, 0, 79, 370, $color, $font, $name1);
		$name2 = $name[2];
		imagettftext($image, 50, 0, 79, 430, $color, $font, $name2);
	}
	imagettftext($image, 30, 0, 79, 600, $color, $font, $courseName);
	imagepng($image);
	imagedestroy($image);

?>