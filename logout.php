<?php
$host = $_SERVER ['HTTP_HOST'];
$uri = rtrim ( dirname ( $_SERVER ['PHP_SELF'] ), '/\\' );

session_unset();
if (ini_get("session.use_cookies")) {
	$params = session_get_cookie_params();
	setcookie(session_name(), '', time() - 42000,
			$params["path"], $params["domain"],
			$params["secure"], $params["httponly"]
			);
}
session_destroy();
header ("Location: https://$host$uri/index.php");
?>