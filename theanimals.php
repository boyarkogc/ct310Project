<?php
session_start ();
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
			
			<p>Welcome to our backyard. Here you can take a look at any of the dogs we currently have available for adoption. Each of these gorgeous animals is looking for a new family to love and cerish them. Click on any of our furry friends to learn more about them.</p>
			<div class="DogPhotos"> 
				<a href="dog1.php"><img src="Media/dog1.jpg"></a>
				<a href="dog2.php"><img src="Media/dog2.jpg"></a>
				<a href="dog3.php"><img src="Media/dog3.jpg"></a> 
				<a href="dog4.php"><img src="Media/dog4.jpeg"></a> 
			</div>

			<?php if(isset($_SESSION["username"])): ?>
					<button type="button" class="AddAnimalButton" onclick="alert('This has not been implemented.')">Add a new Animal!</button>		
				<?php endif; ?>	

			<?php include 'footer.php' ?>
		</div>
	</body>
</html>
