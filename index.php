<?php
session_start ();
include 'header.php';
include 'nav.php';
?>

<?php if (isset($_SESSION['startTime'])) { echo "Time logged in: " . (time() - $_SESSION['startTime']); } ?>

<?php include 'footer.php'; ?>
