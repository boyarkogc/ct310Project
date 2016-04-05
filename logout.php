<?php
session_start();
$host = $_SERVER['HTTP_HOST'];
$uri = rtrim (dirname($_SERVER['PHP_SELF']), '/\\');
session_unset();
session_destroy();
header ("Location: https://$host$uri/index.php");
?>