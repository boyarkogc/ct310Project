<?php
include "lib/support.php";

session_start();
$host = $_SERVER['HTTP_HOST'];
$uri = rtrim (dirname($_SERVER['PHP_SELF']), '/\\');
$current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if (isset($_POST['newpass']) && isset($_POST['confirmnewpass'])) {
	if (filter_var($_POST['newpass'], FILTER_SANITIZE_SPECIAL_CHARS) == filter_var($_POST['confirmnewpass'], FILTER_SANITIZE_SPECIAL_CHARS)) {
		$h = password_hash(filter_var($_POST['newpass'], FILTER_SANITIZE_SPECIAL_CHARS));
		$u = $_SESSION['tempusername'];
		updatePasswordHash($u, $h);
		header ( "Location: https://$host$uri/index.php" );
	}else {
		$pass_error = "Error: your password fields did not match";
	}
}elseif (isset($_GET['reset']) && isset($_SESSION ['reset'] )) {
	if (filter_var($_SESSION['reset'], FILTER_SANITIZE_SPECIAL_CHARS) == filter_var($_GET['reset'], FILTER_SANITIZE_SPECIAL_CHARS)):?>
		<div class="contents">
			<?php include 'header.php'; ?>
			<?php if (isset($pass_error)) {echo $pass_error . "\n";}?>

			<p>Enter and confirm your new password</p>
			<?php $link = "password_reset.php?reset=".$_SESSION['reset'];?>
			<form action=<?php echo $link?> method="post" style="padding:1%">	
				<input type="password" name="newpass" />
				<input type="password" name="confirmnewpass" />
				<button type="submit">Reset password</button> 
			</form>
	<?php
	endif;
}else {
	if (isset($_POST['done'])) {
		$user_name = isset($_POST['user_name']) ? filter_var($_POST['user_name'], FILTER_SANITIZE_SPECIAL_CHARS) : "";
		$_SESSION['tempusername'] = $user_name;
		if (usernameExists($user_name)) {
			$email = getEmailByUsername($user_name);
			$key = str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz');
			$page = $current_url . "?reset=" . $key;
			$_SESSION['reset'] = $key;
			if (mail($email, "Password Reset for CT310 Project", "Please follow this link to reset your password: " . $page)) {
				$reset_message = "Your password reset email has been sent.";
			}else {
				$reset_message = "There was a problem sending your password reset email";
			}
		}else {
			$reset_message = "Error: no such user exists\n";
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
			<?php include 'inc/header.php' ?>
			<?php if (isset($reset_message)) { echo $reset_message . "\n"; } ?>
			<form method='post' style="padding:1%">
				Username <input type="text" name="user_name" required><br><br>
				<input type="hidden" value="done" name="done">
				<input type='submit' value='Send Reset Email'><br>
			</form>		
<?php } ?>	
			<?php include 'inc/footer.php'; ?> 
		</div>
	</body>
</html>
