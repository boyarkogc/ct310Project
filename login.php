<?php 
include 'support.php';
session_start();

$users = readUsers(); 

if (isset ( $_POST ['login'] )) {
	$user = strip_tags($_POST ['userName']);
	$pass = strip_tags($_POST ['password']);
	if (userHashByName($users, $user) == salt($user, $pass)) {
		$_SESSION ['startTime'] = time();
		$_SESSION ['userName'] = $user;
	}
}

include 'header.php';
?>

<form method="post" action="login.php">
	Username: <input type="text" name="userName" size="30"><br/>
	Password: <input type="password" name="password" size="30"><br/>
	<input type="hidden" value="done" name="login">
	<input type="submit" value="Login">
</form>

<a href="index.php">Home</a>
<?php echo "Time logged in: " . (time() - $_SESSION['startTime']); ?>

<?php include 'footer.php'; ?>