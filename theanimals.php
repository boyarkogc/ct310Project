<!DOCTYPE html>
<html>
<meta name="Jacob Muzzy">
<link rel="stylesheet" type="text/css" href="../../style.css">
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css">

<?php
session_start ();
include 'header.php';
include 'nav.php';
?>
<div id="theanimalsbody">
	<h3>
	Available Dogs
	</h3>
	
	<div id = "animalpage">
			<a href="dog1.php">
				Rex </a>
			<div id = "Rex">
				<img src="dog1.jpg" height="200" width="200">
			</div>
	</div>
	<div id = "animalpage">
			<a href="dog2.php">
				Willow </a>
			<div id = "Rex">
				<img src="dog2.jpg" height="200" width="200">
			</div>
	</div>
	<div id = "animalpage">
			<a href="dog3.php">
				Captain Giggles </a>
			<div id = "Rex">
				<img src="dog3.jpg" height="200" width="200">
			</div>
	</div>
	<div id = "animalpage">
			<a href="dog4.php">
				Killer </a>
			<div id = "Killer">
				<img src="dog4.jpeg" height="200" width="200">
			</div>
	</div>
	
	
	<h4>
	We currently do not have any other animals than what are posted above. Please check back later for more.
	</h4>
	
</div>

</body>


<?php include 'footer.php'; ?>
