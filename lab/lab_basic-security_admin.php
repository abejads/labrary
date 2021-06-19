<?php
	session_start();
	if(!isset($_SESSION["uid"])){
	    header("Location: index.php");
	    die();
	}

	require_once("../include/connection.php");

	$file = basename($_SERVER['SCRIPT_FILENAME']);
	$doQuery = $conn->prepare("SELECT * FROM rooms JOIN labs ON rooms.labID = labs.labID WHERE labs.labPath LIKE CONCAT('%',?,'%')");

	if($doQuery->bind_param("s", $file) && $doQuery->execute()){
		$result = $doQuery->get_result();
		while ($course = $result->fetch_assoc()){
			$courseID = $course['courseID'];
			break;
		}

		$doQuery = $conn->prepare("SELECT * FROM certificates WHERE courseID = ?");

		if($doQuery->bind_param("i", $courseID) && $doQuery->execute()){
			$result = $doQuery->get_result();
			if($result->num_rows > 0){
				echo '<script>alert("You have been completed this lab, try another lab!"); window.location = "../course.php";</script>';
				die();
			}
		}
	
	} else {
		echo '<script>alert("Error!")<script>';
        die();
	}

?>
<?php
	if(isset($_COOKIE['disabled'])){
		if(isset($_POST['logout'])){
			unset($_COOKIE['disabled']);
	    	setcookie('disabled', '', time() - 3600, '/'); 

		} else if(strtolower($_COOKIE['disabled']) == 'false'){
			$error = 100;

			$certID = md5(uniqid(time(), true));
			$doQuery = $conn->prepare("INSERT INTO certificates VALUES(?, ?, ?)");

			if($doQuery->bind_param("sii", $certID, $courseID, $_SESSION['uid']) && $doQuery->execute()){

				$certID = $certID;

			} else {
				echo '<script>alert("Error!")<script>';
        		die();
			}



		} else {
			$error = 1;	

		}

	} else if(isset($_POST['username']) && $_POST['username'] != "" && isset($_POST['password']) && $_POST['password'] != ""){
		if($_POST['username'] == 'admin' && $_POST['password'] == 'admin'){
			setcookie("disabled","true", time() + (3600 * 30), "/");
			$error = 1;
		} else {
			$error = 2;
		}
	} else 
?>

<?php if($error == 100): ?>
	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<title>Congrats!</title>
	</head>
	<body>
	<center>
		<h1 style="margin-bottom: 10%;">Congratulations!</h1>
		<h1>You completed this lab, heres your <a href="../certificate.php?certID=<?php echo certID; ?>">certificates</a></h1>
	</center>

	</body>
	</html>
<?php elseif($error == 1): ?>
	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<title>Admin Panel</title>
	</head>
	<body>
	<center>
		<h1 style="margin-bottom: 10%;">This user has been disabled for security issue, you cant access the flag</h1>
		<form method="POST"><button name="logout">Log Out</button></form>
	</center>

	</body>
	</html>
<?php else: ?>
	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<title>Admin Login</title>
	</head>
	<body>
	<center>
		<h1>Admin Login Area</h1>
		<p style="margin-bottom: 10%;">You must logged in with admin account to access the flag
		<form method="POST">
			<label for="username">Username: </label>
			<input type="text" name="username" id="username">
			<p>
			<label for="password">Password: </label>
			<input type="password" name="password" id="password">
			<?php if($error == 2){ echo '<p style="color:red">Incorrect username/password</p>'; }; ?>
			<p>
			<button type="submit">Login</button>
		</form>
	</center>

	</body>
	</html>
<?php endif; ?>