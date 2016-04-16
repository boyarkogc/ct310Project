<?php
session_start();
include 'lib/support.php';
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
			<?php include 'inc/header.php' ?>

			<p>Welcome to our backyard. Here you can take a look at any of the dogs we currently have available for adoption. Each of these gorgeous animals is looking for a new family to love and cerish them. Click on any of our furry friends to learn more about them.</p>

			<form>
				Search for a particular pet: <input type="text" onkeyup="search(this.value)">
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
			<?php include 'inc/footer.php' ?>
		</div>
	</body>
</html>
