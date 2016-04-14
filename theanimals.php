<?php
session_start ();
include 'lib/support.php';
include 'inc/header.php';
?>
<div class="Content">

	<p>Welcome to our backyard. Here you can take a look at any of the dogs we currently have available for adoption. 
	Each of these gorgeous animals is looking for a new family to love and cerish them. Click on any of our furry friends to learn more about them.</p>

	<?php
	$images = getImagePerPet();
	foreach ( $images as $img ) { 
	?>
		<div class="DogPhotos"> 
			<a href="dog1.php"><img src="getImage.php?image_id=<?php echo $img["image_id"];?>" alt =""></a>
		</div>
 	<?php }; ?>
	<!--<div class="DogPhotos"> 
		<a href="dog1.php"><img src="Media/dog1.jpg"></a>
		<a href="dog2.php"><img src="Media/dog2.jpg"></a>
		<a href="dog3.php"><img src="Media/dog3.jpg"></a> 
		<a href="dog4.php"><img src="Media/dog4.jpeg"></a> 
	</div>-->
	<?php if(isset($_SESSION["username"])): ?>
		<button type="button" class="AddAnimalButton" onclick="alert('This has not been implemented.')">Add a new Animal!</button>		
	<?php endif; ?>	
</div>
<?php include 'inc/footer.php'; ?>
