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

			<?php if (isset($_SESSION['username'])) { ?>
				<div class="LoginTitle">You are currently logged in as <?php echo $_SESSION['username']; ?>.</div>
			<?php } else { ?>
				<div class="LoginTitle">LOGIN</div>
			<?php }; ?>

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

			<?php if (($ip >= ip2long("129.82.44.0") && $ip <= ip2long("129.82.45.255")) OR ($ip >= ip2long("97.124.253.0") && $ip <= ip2long("97.124.253.255")) OR ($ip >= ip2long("75.166.60.0") && $ip <= ip2long("75.166.60.255"))){ ?>
				<form action="create_account.php">
					<button type="submit" class="NewAccountButton">Don't Have an Account?  Click Here!</button>
				</form>	
        		<?php }; ?>			
			<?php include 'footer.php' ?>
		</div>
	</body>
</html>
