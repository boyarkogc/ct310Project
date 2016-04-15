<?php
include "lib/support.php";

session_start();

if (isset($_POST['done'])) {
	$user_name = isset($_POST['user_name']) ? $_POST['user_name'] : "";
	$password = isset($_POST['password']) ? $_POST['password'] : "";
	$pass_hash = password_hash($password);
	$first_name = isset($_POST['first_name']) ? $_POST['first_name'] : "";
	$middle_name = isset($_POST['middle_name']) ? $_POST['middle_name'] : "";
	$last_name = isset($_POST['last_name']) ? $_POST['last_name'] : "";
	$phone_number = isset($_POST['phone_number']) ? $_POST['phone_number'] : "";
	$email = isset($_POST['email']) ? $_POST['email'] : "";
	$owns_dog = isset($_POST['owns_dog']) ? $_POST['owns_dog'] : False;
	$owns_cat = isset($_POST['owns_cat']) ? $_POST['owns_cat'] : False;
	$owns_turtle = isset($_POST['owns_turtle']) ? $_POST['owns_turtle'] : False;
	$foster_interest = isset($_POST['foster_interest']) ? $_POST['foster_interest'] : False;
	$has_pet_to_foster = isset($_POST['has_pet_to_foster']) ? $_POST['has_pet_to_foster'] : False;
	$foster_explanation = isset($_POST['foster_explanation']) ? $_POST['foster_explanation'] : "";

	if (addUser($user_name, $pass_hash, $first_name, $middle_name, $last_name, 
	$phone_number, $email, $owns_dog, $owns_cat, $owns_turtle, 
	$foster_interest, $has_pet_to_foster, $foster_explanation) == -1) {
		echo "Error creating account";
	}else {
		echo "Account created successfully";
	}
}
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
			
			<div class="CreateAccount">
				<form method='post'>
					First Name: <input type="text" name="first_name" required><br><br>
					Middle Name: <input type="text" name="middle_name" "><br><br>
					Last Name: <input type="text" name="last_name" ;required><br><br>
					Username: <input type="text" name="user_name" required><br><br>
					Password: <input type="password" name="password" required><br><br>
					Repeat Password: <input type="password" name="password" required><br><br>
					Phone Number: <input type="text" name="phone_number"><br><br>
					Email: <input type="email" name="email" required><br><br>
					Do you own any of the following animals? <br><br>
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

			<?php include 'footer.php' ?>
		</div>
	</body>
</html>
