<?php
session_start ();
include 'lib/support.php';
include 'inc/header.php';
?>
<script type="text/javascript">
	var http = new XMLHttpRequest();

	function search(str) {
		http.abort();
		if (str.length==0) {
			document.getElementById("live_search").innerHTML="";
			document.getElementById("live_search").style.border="0px";
			return;
		}
		http.open("GET", 'live_search.php?q=' + str, true);
		http.onreadystatechange = function() {
			if (http.readyState == 4) {
				document.getElementById('live_search').innerHTML = http.responseText;
				document.getElementById("live_search").style.border="1px solid #A5ACB2";
			}
		}
		http.send(null);
	}

</script>
<div class="Content">

	<p>Welcome to our backyard. Here you can take a look at any of the dogs we currently have available for adoption. 
	Each of these gorgeous animals is looking for a new family to love and cerish them. Click on any of our furry friends to learn more about them.</p>

	<form>
		<input type="text" onkeyup="search(this.value)">
		<div id="live_search"></div>
	</form>

	<?php
	$images = getImagePerPet();
	foreach ( $images as $img ) { 
	?>
		<div class="DogPhotos"> 
			<a href="pet.php?image_id=<?php echo $img["image_id"]; ?>"><img src="getImage.php?image_id=<?php echo $img["image_id"];?>" alt ="Image missing for this pet"></a>
		</div>
 	<?php }; ?>
	<?php if(isset($_SESSION["username"])): ?>
		<button type="button" class="AddAnimalButton" onclick="alert('This has not been implemented.')">Add a new Animal!</button>		
	<?php endif; ?>	
</div>
<?php include 'inc/footer.php'; ?>
