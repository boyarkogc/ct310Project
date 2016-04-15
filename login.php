<?php 
include 'lib/support.php';
session_start();

$host = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

if (isset ($_POST['login'])) {
	$user = $_POST['username'];
	$pass = $_POST['password'];
	if (password_verify($pass, userHashByName($user))) {
		$_SESSION['startTime'] = time();
		$_SESSION['username'] = $user;
	}
}
?>
<?php include 'inc/header.php'; ?>
	<div class="Content">
		<div class="LoginTitle">LOGIN</div>
		<div id="loginform">
			<form method="post" action="login.php" class="Login">
				Username: <input type="text" name="username" size="30" class="LoginField"><br/>
				Password: <input type="password" name="password" size="30" class="LoginField"><br/>
				<input type="hidden" value="done" name="login">
				<input type="submit" value="Login" class="LoginButton">
			</form>
		</div>
		<a href="create_account.php">Create account</a><br>
		<a href="password_reset.php">Forgot your password?</a><br>
	</div>
<?php include 'inc/footer.php'; ?>
