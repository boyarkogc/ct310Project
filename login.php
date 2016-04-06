<?php 
include 'support.php';
session_start();
initializeDatabase();

$host = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

if (isset ($_POST['login'])) {
	$user = $_POST['userName'];
	$pass = $_POST['password'];
	if (password_verify($pass, userHashByName($user))) {
		$_SESSION['startTime'] = time();
		$_SESSION['userName'] = $user;
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


include 'header.php';
include 'nav.php';
?>

<div id="loginform">
<form method="post" action="login.php">
	Username: <input type="text" name="userName" size="30"><br/>
	Password: <input type="password" name="password" size="30"><br/>
	<input type="hidden" value="done" name="login">
	<input type="submit" value="Login">
</form>
</div>

<?php include 'footer.php'; ?>