<?php 
session_start ();
include 'header.php';
include 'nav.php';
?>

<<<<<<< HEAD
<?php if (isset($_SESSION['startTime'])) { echo "Time logged in: " . (time() - $_SESSION['startTime']); } ?>

<?php include 'footer.php'; ?>
=======
<a href="login.php">Login</a><br>

<?php if (isset($_SESSION['startTime'])) { echo "Time logged in: " . (time() - $_SESSION['startTime']); } ?>

<?php include 'footer.php'; ?>
>>>>>>> 79661f631a8b32d15cf406ba587129187f12f480
