<?php
	if(isset($_COOKIE['disabled'])){
		if(isset($_POST['logout'])){
			unset($_COOKIE['disabled']);
	    	setcookie('disabled', '', time() - 3600, '/'); 

		} else if(strtolower($_COOKIE['disabled']) == 'false'){
			$error = 100;

		} else {
			$error = 1;	

		}

	} else if(isset($_POST['username']) && $_POST['username'] != "" && isset($_POST['password']) && $_POST['password'] != ""){
		if($_POST['username'] == 'admin' && $_POST['password'] == 'admin'){
			setcookie("disabled","true", time() + (86400 * 30), "/");
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
		<h1 style="margin-bottom: 10%;">This flag for you</h1>
		<h1>L4bR@Ry{c00k13_m4N1pUl4t10n}</h1>
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
		<p style="margin-bottom: 10%;">You must logged in wtih admin account to access the flag
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