<?php 
session_start ();
include 'header.php';
include 'nav.php';
?>

<a href="login.php">Login</a><br>

<?php if (isset($_SESSION['startTime'])) { echo "Time logged in: " . (time() - $_SESSION['startTime']); } ?>

<?php include 'footer.php'; ?>