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
		            <img src="pictures/dog1.jpg" class="Dog">
		            <div class="PetDescription">A wonderful mixed breed dog. [Dog 1 Description]</div>
            
		            <?php
				if (isset($_POST['op'])) {
                		    $op  = $_POST['content'];
    	        		    error_reporting(0);
    	        		    if($op) {
    	        		    	echo "<div class="FormResponse">Your Comments was Sent</div>\n";
    	        		    	echo "<blockquote> \n $content \n </blockquote>\n";
                			}
               			 } else {
               			     echo "<div class="FormResponse">You haven't logged in yet! You can't comment without logging in. </div>";
 			         }
 		           ?>
            <p><strong>Login to make a comment about one of our available pets.</strong></p>

            <form method="post" action="login.php">
                <textarea name="content" rows="5" cols="40" placeholder="Your comment here."></textarea><br/>
                <input type="hidden" value="done" name="op">
                <input type="submit" value="submit">
            </form>            

			<?php include 'footer.php' ?>
		</div>
	</body>
</html>
<div id="entirepage">
	<div id="title">
		<H2>
		Rex
		</H2>
	</div>
	<a href="#" title="Image source: https://www.petfinder.com/wp-content/uploads/2012/11/dog-how-to-select-your-new-best-friend-thinkstock99062463.jpg">
		<img src="dog1.jpg" height="200" width="200">
	</a>
	
	<div id ="descriptionofanimal">
		<p>
		Rex is a dark haired Golden Retriever that loves to be lazy and get belly rubs
	
	
	
	
		</p>
	</div>
</div>





<?php
include 'pet_template.php';
?>
