<?php
include "lib/support.php";
include "lib/config.php";
//don't need to initialize database here, because user must be logged in; database must have already been initialized

session_start ();
//if not logged in, redirect to homepage
$host = $_SERVER['HTTP_HOST'];
$uri = rtrim (dirname($_SERVER['PHP_SELF']), '/\\');
if (!isset($_SESSION['username'])) {
	header ("Location: https://$host$uri/login.php");
}

$max_file_size = 500000;
if (isset($_POST['done'])) {
	//adds pet to the pet table
	$pet_name = filter_var($_POST['pet_name'], FILTER_SANITIZE_SPECIAL_CHARS);
	$pet_type = filter_var($_POST['pet_type'], FILTER_SANITIZE_SPECIAL_CHARS);
	$weight = filter_var($_POST['weight'], FILTER_SANITIZE_SPECIAL_CHARS);
	$summary = isset($_POST['summary']) ? filter_var($_POST['summary'], FILTER_SANITIZE_SPECIAL_CHARS) : "";
	$details = isset($_POST['details']) ? filter_var($_POST['details'], FILTER_SANITIZE_SPECIAL_CHARS) : "";
	$pet_id = addPet($pet_name, $pet_type, $weight, $summary, $details);
	if ($pet_id == -1) {
		$error_msg_pet = "Error adding pet";
	}
	//adds image to the pet_image table, with a foreign key corresponding to the pet
	if ($_FILES ["image"]["error"] == UPLOAD_ERR_OK) {
		if ($_FILES ["image"]["size"] > $max_file_size) {
			$error_msg = "File is too large.";
		} else {
			$ext = parseFileSuffix($_FILES ['image']['type']);
			if ($ext == '') {
				$error_msg = "Invalid file type. Supported file types are .jpg and .png";
			} else {
				// Let database save assign unique integer id.
				$fid = saveImage($_FILES ["image"], $ext, $pet_id);
				if ($fid == - 1) {
					$error_msg = "Unable to store image in DB";
				} else {
					if (! file_exists ( $config->upload_dir )) {
						if (! mkdir ( $config->upload_dir )) {
							$error_msg = "Attempt to make folder: \"" . $config->upload_dir . "\" failed";
						}
					}
					$filename = str_pad ( $fid, $config->pad_length, "0", STR_PAD_LEFT ) . "." . $ext;
					move_uploaded_file ( $_FILES ["image"] ["tmp_name"], $config->upload_dir . $filename );
				}
			}
		}
	} else if ($_FILES ["image"] ["error"] == UPLOAD_ERR_INI_SIZE || $_FILES ["image"] ["error"] == UPLOAD_ERR_FORM_SIZE) {
		$error_msg = "File is too large.";
	} else {
		$error_msg = "An error occured. Please try again. <!-- " . $_FILES ["image"] ["error"] . " -->";
	}
}

if (isset($error_msg_pet)) {
	echo $error_msg_pet;
}
if (isset ( $error_msg )) {
	echo $error_msg;
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
			<?php include 'inc/header.php' ?>
			<form method='post' enctype="multipart/form-data">
			Pet Name:<br>
			<input type="text" name="pet_name" required><br>
			Pet Type(Cat, Dog, etc.):<br>
			<input type="text" name="pet_type" required><br>
			Weight(in pounds):<br>
			<input type="number" name="weight" required><br>
			Short Summary:<br>
			<textarea name='summary'></textarea><br>
			Additional Details:<br>
			<textarea name='details'></textarea><br>
			Picture:<br>
			<input type="file" name="image" id="image" required/><br>
			<br>
			<input type="hidden" value="done" name="done">
			<input type='submit' value='Submit'><br>
		</form>
		<?php include 'inc/footer.php' ?>
		</div>
	</body>
</html>
<?php 

function parseFileSuffix($iType) {
	if ($iType == 'image/jpeg') {
		return 'jpg';
	}
	if ($iType == 'image/png') {
		return 'png';
	}
	return '';
}

?>
