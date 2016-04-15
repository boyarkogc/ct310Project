<?php
include "lib/support.php";

session_start();
$host = $_SERVER['HTTP_HOST'];
$uri = rtrim (dirname($_SERVER['PHP_SELF']), '/\\');
$current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if (isset($_POST['newpass']) && isset($_POST['confirmnewpass'])) {
	if ($_POST['newpass'] == $_POST['confirmnewpass']) {
		$h = password_hash($_POST['newpass']);
		$u = $_SESSION['tempusername'];
		updatePasswordHash($u, $h);
		header ( "Location: https://$host$uri/index.php" );
	}else {
		echo "Error: your password fields did not match";
	}
}elseif (isset($_GET['reset']) && isset($_SESSION ['reset'] )) {
	if ($_SESSION['reset'] == $_GET['reset']):?>
		</head>
	<!-- Start of page Body -->
		<body>
		<div class="contents">
			<p>Enter and confirm your new password</p>
			<?php $link = "password_reset.php?reset=".$_SESSION['reset'];?>
			<form action=<?php echo $link?> method="post">	
				<input type="password" name="newpass" />
				<input type="password" name="confirmnewpass" />
				<button type="submit">Reset password</button> 
			</form>
		</div>
	<?php
	endif;
}else {
	if (isset($_POST['done'])) {
		$user_name = isset($_POST['user_name']) ? $_POST['user_name'] : "";
		$_SESSION['tempusername'] = $user_name;
		if (usernameExists($user_name)) {
			$email = getEmailByUsername($user_name);
			$key = str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz');
			$page = $current_url . "?reset=" . $key;
			$_SESSION['reset'] = $key;
			if (mail($email, "Password Reset for CT310 Project", "Please follow this link to reset your password: " . $page)) {
				echo "Your password reset email has been sent.";
			}else {
				echo "There was a problem sending your password reset email";
			}
		}else {
			echo "Error: no such user exists\n";
		}
	}
	include 'inc/header.php';
	?>

	<div class="Content">	
		<form method='post'>
			Username <input type="text" name="user_name" required><br><br>
			<input type="hidden" value="done" name="done">
			<input type='submit' value='Send Reset Email'><br>
		</form>		
	</div>
	<?php
}
include 'inc/footer.php'; ?>