<?php 
include 'lib/support.php';
session_start();
initializeDatabase();

$host = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

if (isset ($_POST['login'])) {
	$user = $_POST['username'];
	$pass = $_POST['password'];
	if (password_verify($pass, userHashByName($user))) {
		$_SESSION['startTime'] = time();
		$_SESSION['username'] = $user;
	}/*else {
		echo userHashByName($user);
		echo 'hi';
		echo 'hi';
		echo 'hi';

		echo 'hi';
		echo 'hi';

		echo 'hi';
		echo 'hi';
		echo password_verify($user, $pass);
	}*/
	//header("Location: https://$host$uri/index.php");
}
?>
<!DOCTYPE HTML>
<html lang="en-US">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="author" content="Greg Boyarko, Alexander Hennings" />
		<meta name="description" content="A fake adoption site created for the second CT310 Project at Colorado State University."/>
		<title>Animal Rescue and Adoption Center</title>
		<link href="css/style.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div class="Content">
			<?php include 'header.php' ?>
			<div class="LoginTitle">LOGIN</div>
			<div id="loginform">
				<form method="post" action="login.php" class="Login">
					Username: <input type="text" name="username" size="30" class="LoginField"><br/>
					Password: <input type="password" name="password" size="30" class="LoginField"><br/>
					<input type="hidden" value="done" name="login">
					<input type="submit" value="Login" class="LoginButton">
				</form>
			</div>
			<form action="password_reset.php">
				<button type="submit" class="NewPasswordButton">Forgot Your Password? Reset it here.</button>
			</form>	
			
			<form action="create_account.php">
				<button type="submit" class="NewAccountButton">Don't Have an Account?  Click Here!</button>
			</form>		
			<?php include 'footer.php' ?>
		</div>
	</body>
</html>
