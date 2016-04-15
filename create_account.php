<?php
include "lib/support.php";

session_start();
$ip = ip2long($_SERVER['REMOTE_ADDR']);
$host = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
if (!($ip >= ip2long("129.82.44.0") && $ip <= ip2long("129.82.45.255")) AND !($ip >= ip2long("97.124.253.0") && $ip <= ip2long("97.124.253.255"))) {
    header ("Location: https://$host$uri/index.php");
}

if (isset($_POST['done'])) {
	$user_name = isset($_POST['user_name']) ? filter_var($_POST['user_name'], FILTER_SANITIZE_SPECIAL_CHARS) : "";
	$password = isset($_POST['password']) ? filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS) : "";
	$pass_hash = password_hash($password);
	$first_name = isset($_POST['first_name']) ? filter_var($_POST['first_name'], FILTER_SANITIZE_SPECIAL_CHARS) : "";
	$middle_name = isset($_POST['middle_name']) ? filter_var($_POST['middle_name'], FILTER_SANITIZE_SPECIAL_CHARS) : "";
	$last_name = isset($_POST['last_name']) ? filter_var($_POST['last_name'], FILTER_SANITIZE_SPECIAL_CHARS) : "";
	$phone_number = isset($_POST['phone_number']) ? filter_var($_POST['phone_number'], FILTER_SANITIZE_SPECIAL_CHARS) : "";
	$email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS) : "";
	$owns_dog = isset($_POST['owns_dog']) ? filter_var($_POST['owns_dog'], FILTER_SANITIZE_SPECIAL_CHARS) : False;
	$owns_cat = isset($_POST['owns_cat']) ? filter_var($_POST['owns_cat'], FILTER_SANITIZE_SPECIAL_CHARS) : False;
	$owns_turtle = isset($_POST['owns_turtle']) ? filter_var($_POST['owns_turtle'], FILTER_SANITIZE_SPECIAL_CHARS) : False;
	$foster_interest = isset($_POST['foster_interest']) ? filter_var($_POST['foster_interest'], FILTER_SANITIZE_SPECIAL_CHARS) : False;
	$has_pet_to_foster = isset($_POST['has_pet_to_foster']) ? filter_var($_POST['has_pet_to_foster'], FILTER_SANITIZE_SPECIAL_CHARS) : False;
	$foster_explanation = isset($_POST['foster_explanation']) ? filter_var($_POST['foster_explanation'], FILTER_SANITIZE_SPECIAL_CHARS) : "";

	if (addUser($user_name, $pass_hash, $first_name, $middle_name, $last_name, 
	$phone_number, $email, $owns_dog, $owns_cat, $owns_turtle, 
	$foster_interest, $has_pet_to_foster, $foster_explanation) == -1) {
		echo "Error creating account";
	}else {
		echo "Account created successfully";
	}
}

include 'inc/header.php';
?>
<div class="Content">	
	<form method='post'>
		Username <input type="text" name="user_name" required><br><br>
		Password <input type="password" name="password" required><br><br>
		First Name <input type="text" name="first_name" required><br><br>
		Middle Name <input type="text" name="middle_name"><br><br>
		Last Name <input type="text" name="last_name" required><br><br>
		Phone Number <input type="text" name="phone_number"><br><br>
		Email <input type="email" name="email" required><br><br>
		Do you own any of the following animals?
		Dog <input type="checkbox" name="owns_dog" value="owns_dog"> 
		Cat <input type="checkbox" name="owns_cat" value="owns_cat"> 
		Turtle <input type="checkbox" name="owns_turtle" value="owns_turtle"><br><br>
		Are you interested in fostering a pet? <input type="checkbox" name="foster_interest" value="foster_interest"><br><br>
		Do you have a pet you would like to put up for adoption? <input type="checkbox" name="has_pet_to_foster" value="has_pet_to_foster"><br><br>
		If so, please provide additional details about the pet.<br><br>
		<textarea name="foster_explanation" id="foster_explanation" placeholder="Foster pet details" rows="4" cols="50"></textarea><br><br>
		<br><br>
		<input type="hidden" value="done" name="done">
		<input type='submit' value='Submit'><br>
	</form>		
</div>
<?php include 'inc/footer.php' ?>