<?php 
include 'support.php';
session_start();

$host = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$host = $_SERVER ['HTTP_HOST'];
$uri = rtrim ( dirname ( $_SERVER ['PHP_SELF'] ), '/\\' );
$users = readUsers(); 

if (isset ($_POST['login'])) {
	$user = filter_var($_POST['userName'], FILTER_SANITIZE_STRING);
	$pass = strip_tags($_POST['password'], FILTER_SANITIZE_STRING);
	if (userHashByName($users, $user) == salt($user, $pass)) {
		$_SESSION['startTime'] = time();
		$_SESSION['userName'] = $user;
	}
	header("Location: https://$host$uri/index.php");
}

include 'header.php';
include 'nav.php';
?>

<form method="post" action="login.php">
	Username: <input type="text" name="userName" size="30"><br/>
	Password: <input type="password" name="password" size="30"><br/>
	<input type="hidden" value="done" name="login">
	<input type="submit" value="Login">
</form>

<?php if (isset($_SESSION['startTime'])) { echo "Time logged in: " . (time() - $_SESSION['startTime']); } ?>

<?php include 'footer.php'; ?>