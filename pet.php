<?php
include 'lib/support.php';
session_start ();
$host = $_SERVER['HTTP_HOST'];
$uri = rtrim (dirname($_SERVER['PHP_SELF']), '/\\');

if (!isset($_GET["image_id"])) {
	header("Location: https://$host$uri/theanimals.php");
}

$imageRecord = getImage ( intval ( $_GET ["image_id"] ) );
if ($imageRecord === FALSE) {
	header("Location: https://$host$uri/theanimals.php");
}

$pet = getPetByImageId($imageRecord["image_id"]);

?>
<!DOCTYPE HTML>
<html lang="en-US">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="author" content="Baradji Diallo, Alexander Hennings" />
		<meta name="description" content="A fake adoption site created for a CT310 Project at Colorado State University."/>
		<title>Animal Rescue and Adoption Center</title>
		<link href="/css/style.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div class="Content">
			<?php include 'inc/header.php' ?>
			<div class="IndividualDogPhoto"><img src="getImage.php?image_id=<?php echo $imageRecord["image_id"];?>" alt =""></div>
			<!--title="Image source: https://www.petfinder.com/wp-content/uploads/2012/11/dog-how-to-select-your-new-best-friend-thinkstock99062463.jpg-->
		        <div class="PetDescription"><?php echo $pet["details"]; ?></div>
            		        
            		<p><strong>Login to make a comment about one of our available pets.</strong></p>

            		<form method="post" action="login.php">
                		<textarea name="content" rows="5" cols="40" placeholder="Your comment here."></textarea><br/>
               			<input type="hidden" value="done" name="op">
               			<input type="submit" value="submit">
           		 </form>            
			<?php include 'pet_template.php' ?>
			<?php include 'inc/footer.php' ?>
		</div>
	</body>
</html>