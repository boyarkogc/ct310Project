<?php
include "lib/support.php";
include "lib/config.php";
//don't need to initialize database here, because user must be logged in; database must have already been initialized

session_start ();
//if not logged in, redirect to homepage
$host = $_SERVER['HTTP_HOST'];
$uri = rtrim (dirname($_SERVER['PHP_SELF']), '/\\');
if (!isset($_SESSION['userName'])) {
	header ("Location: https://$host$uri/index.php");
}

$max_file_size = 500000;
if (isset($_POST['done'])) {
	$pet_name = $_POST['pet_name'];
	$pet_type = $_POST['pet_type'];
	$weight = $_POST['weight'];
	$summary = isset($_POST['summary']) ? $_POST['summary'] : "";
	$details = isset($_POST['details']) ? $_POST['details'] : "";

	//addPet()
	if ($_FILES ["image"]["error"] == UPLOAD_ERR_OK) {
		if ($_FILES ["image"]["size"] > $max_file_size) {
			$error_msg = "File is too large.";
		} else {
			$ext = parseFileSuffix($_FILES ['image']['type']);
			if ($ext == '') {
				$error_msg = "Invalid file type. Supported file types are .jpg and .png";
			} else {
				// Let database save assign unique integer id.
				$fid = saveImage($_FILES ["image"], $ext, $pet_name);
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

include 'inc/header.php';
//include 'inc/nav.php';

if (isset ( $error_msg )) {
	echo $error_msg;
}
?>

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

<?php include 'inc/footer.php';

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