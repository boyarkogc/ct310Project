<?php
session_start ();
?>
<!DOCTYPE HTML>
<html lang="en-US">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="author" content="Baradji Diallo, Alexander Hennings" />
		<meta name="description" content="A fake adoption site created for a CT310 Project at Colorado State University."/>
		<title>Animal Rescue and Adoption Center</title>
		<link href="css/style.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div class="Content">
			<?php include 'header.php' ?>
			<div class="IndividualDogPhoto"><img src="Media/dog1.jpg" title="Image source: https://www.petfinder.com/wp-content/uploads/2012/11/dog-how-to-select-your-new-best-friend-thinkstock99062463.jpg"></div>
		        <div class="PetDescription">Rex is a dark haired Golden Retriever that loves to be lazy and get belly rubs.</div>
            		        
            		<p><strong>Login to make a comment about one of our available pets.</strong></p>

            		<form method="post" action="login.php">
                		<textarea name="content" rows="5" cols="40" placeholder="Your comment here."></textarea><br/>
               			<input type="hidden" value="done" name="op">
               			<input type="submit" value="submit">
           		 </form>            
			<?php include 'pet_template.php' ?>
			<?php include 'footer.php' ?>
		</div>
	</body>
</html>
		
