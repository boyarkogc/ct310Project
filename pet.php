<?php
include 'lib/support.php';
session_start ();
$host = $_SERVER['HTTP_HOST'];
$uri = rtrim (dirname($_SERVER['PHP_SELF']), '/\\');
$current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if (!isset($_GET["image_id"])) {
	header("Location: https://$host$uri/theanimals.php");
}

$imageRecord = getImage ( intval ( $_GET ["image_id"] ) );
if ($imageRecord === FALSE) {
	header("Location: https://$host$uri/theanimals.php");
}

$pet = getPetByImageId($imageRecord["image_id"]);

if (isset($_POST['done'])) {
	$username = $_SESSION['username'];
	$pet_id = $pet['pet_id'];
	$comment = filter_var($_POST['comment'], FILTER_SANITIZE_SPECIAL_CHARS);
	$status = addComment($username, $pet_id, $comment);
	header("Location: $current_url");
}
?>

<?php include 'inc/header.php' ?>
	<div class="Content">
		<div class="IndividualDogPhoto"><img src="getImage.php?image_id=<?php echo $imageRecord["image_id"];?>" alt =""></div>
		<!--title="Image source: https://www.petfinder.com/wp-content/uploads/2012/11/dog-how-to-select-your-new-best-friend-thinkstock99062463.jpg-->
        <div class="PetName"><?php echo $pet["pet_name"]; ?></div><br>
	    <div class="PetDescription"><?php echo $pet["details"]; ?></div><br>
	    <?php
	    $comments = getCommentsForPet($pet['pet_id']);
		foreach ($comments as $c) {
			echo $c['user_name'] . " said: <br>\n" . $c['comment_text'] . "<br>\n";
			echo "<br>\n";
		}
		?>
        <?php if (isset($_SESSION['username'])) { ?>        
            <form method="post"><!--action="php echo $current_url; ?>-->
                <textarea name="comment" id="comment" placeholder="Your comment here." rows="4" cols="50"></textarea><br/>
                <input type="hidden" value="done" name="done">
                <input type="submit" value="submit">
            </form>    
        <?php }else { ?>
    		<p><strong>Login to make a comment about one of our available pets.</strong></p>
        <?php }; ?>  
	</div>
<?php include 'inc/footer.php' ?>