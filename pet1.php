<?php session_start();
$page = basename($_SERVER['PHP_SELF'], '.php');
include 'comment_support.php';
include 'header.php';
include 'nav.php'; ?>
<?php if (isset($_SESSION['userName'])):?>
<?php if (isset($_POST['done'])): ?>
	
<?php endif; ?>
<form method='post'>
  Comment:<br>
  <textarea name='comment' id='comment'></textarea><br>
  <input type='hidden' name='done'>
  <input type='submit' value='Submit'>  
</form>
<?php endif; ?>
<?php include 'footer.php'; ?>
