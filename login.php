<?php 
include 'lib/support.php';
session_start();

$ip = ip2long($_SERVER['REMOTE_ADDR']);
$host = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

if (isset ($_POST['login'])) {
	$user = filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS);
	$pass = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);
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
        <?php if (($ip >= ip2long("129.82.44.0") && $ip <= ip2long("129.82.45.255")) OR ($ip >= ip2long("97.124.253.0") && $ip <= ip2long("97.124.253.255"))) { ?>
		<a href="create_account.php">Create account</a><br>
        <?php }; ?>
		<a href="password_reset.php">Forgot your password?</a><br>
	</div>
<?php include 'inc/footer.php'; ?>
