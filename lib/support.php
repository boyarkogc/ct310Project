<?php
include 'inc/passwordLib.php';

class User {
	public $userName = '';
	public $hash = '';
	public $firstName = '';
	public $middleName = '';
	public $lastName = '';
	public $phoneNumber = '';
	public $email = '';
	public $ownedDogs = False;
	public $ownedCats = False;
	public $ownedTurtles = False;
	public $fosterInterest = False;
	public $hasPetToFoster = False;
	public $fosterExplanation = '';
}

function initializeDatabase() {
	try {
		$dbh = new PDO("sqlite:./petRescue.db");
	} catch (PDOException $e) {
		/* If you get here it is mostly a permissions issue
		* or that your path to the database is wrong
		*/
		echo 'Error: could not connect to database';
		die;
	}

	$sql = "CREATE TABLE IF NOT EXISTS users (user_name VARCHAR(15) PRIMARY KEY, hash CHAR(255), 
		first_name VARCHAR(20), middle_name VARCHAR(20), last_name VARCHAR(20), 
		phone_number CHAR(12), email VARCHAR(40), owned_dogs BOOLEAN, owned_cats BOOLEAN, owned_turtles BOOLEAN,
		foster_interest BOOLEAN, has_pet_to_foster BOOLEAN, foster_explanation VARCHAR(500))";
	$status = $dbh->exec($sql);
	if($status === FALSE){
		echo 'Error encountered setting up users table';
	}

	$sql = "CREATE TABLE IF NOT EXISTS pets (pet_id INTEGER PRIMARY KEY ASC, pet_name VARCHAR(20), pet_type VARCHAR(6), summary VARCHAR(50), details VARCHAR(500), weight INTEGER)";
	$status = $dbh->exec($sql);
	if($status === FALSE){
		echo 'Error encountered setting up pets table';
	}

	$sql = "CREATE TABLE IF NOT EXISTS comments (comment_id INTEGER PRIMARY KEY ASC, user_name VARCHAR(15), pet_id INTEGER, 
		comment_text VARCHAR(2000), FOREIGN KEY(user_name) REFERENCES users(user_name), FOREIGN KEY(pet_id) REFERENCES pets(pet_id))";
	$status = $dbh->exec($sql);
	if($status === FALSE) {
		echo 'Error encountered setting up comments table';
	}

	$sql = "CREATE TABLE IF NOT EXISTS pet_images (image_id INTEGER PRIMARY KEY ASC, pet_id INTEGER, 
		file_name varchar(50), type varchar(50), size int(10), ext varchar(5), FOREIGN KEY(pet_id) REFERENCES pets(pet_id))";
	$status = $dbh->exec($sql);
	if($status === FALSE){
		echo 'Error encountered setting up images table';
	}
	//set up admin account
	$admin_hash = password_hash("12345");
	$sql = "INSERT OR IGNORE INTO users (user_name, hash) VALUES ('admin', '$admin_hash')";
	$status = $dbh->exec($sql);
	if($status === FALSE){
		echo 'Error encountered setting up admin account';
	}
}

function readUsers() {

}

function userHashByName($user_name) {
	try {
		$dbh = new PDO("sqlite:./petRescue.db");
	} catch (PDOException $e) {
		/* If you get here it is mostly a permissions issue
		* or that your path to the database is wrong
		*/
		echo 'Error: could not connect to database';
		die;
	}

	$sql = "SELECT hash FROM users WHERE user_name = '$user_name'";
	$result = $dbh->query($sql);
	$res2 = $result->fetch(PDO::FETCH_ASSOC);
	/*if($result === FALSE ){
		echo $sql;
	}*/
	//$arr = $result->fetchArray();
	$hash = $res2['hash'];
	return $hash;
}

function saveImage($imgArray, $ext, $pet_id){
	try {
		$dbh = new PDO("sqlite:./petRescue.db");
	} catch (PDOException $e) {
		/* If you get here it is mostly a permissions issue
		* or that your path to the database is wrong
		*/
		echo 'Error: could not connect to database';
		die;
	}

	$sql = "INSERT INTO pet_images (file_name, type, size, ext, pet_id) VALUES (?,?,?,?,?)";
	$stm = $dbh->prepare($sql);
	$values = array(
		$imgArray["name"],
		$imgArray["type"],
		$imgArray["size"],
		$ext,
		$pet_id
	);
	if($stm->execute($values) === FALSE){
		return -1;
	}else{
		return $dbh->lastInsertId("image_id");
	}
}

function addPet($pet_name, $pet_type, $weight, $summary, $details) {
	try {
		$dbh = new PDO("sqlite:./petRescue.db");
	} catch (PDOException $e) {
		/* If you get here it is mostly a permissions issue
		* or that your path to the database is wrong
		*/
		echo 'Error: could not connect to database';
		die;
	}

	$sql = "INSERT INTO pets (pet_name, pet_type, weight, summary, details) VALUES (?,?,?,?,?)";
	$stm = $dbh->prepare($sql);
	$values = array(
		$pet_name,
		$pet_type,
		$weight,
		$summary,
		$details
	);
	if($stm->execute($values) === FALSE) {
		return -1;
	}else{
		return $dbh->lastInsertId("pet_id");
	}
}

function addComment($user_name, $pet_id, $comment) {
	try {
		$dbh = new PDO("sqlite:./petRescue.db");
	} catch (PDOException $e) {
		/* If you get here it is mostly a permissions issue
		* or that your path to the database is wrong
		*/
		echo 'Error: could not connect to database';
		die;
	}

	$sql = "INSERT INTO comments (user_name, pet_id, comment_text) VALUES (?,?,?)";
	$stm = $dbh->prepare($sql);
	$values = array(
		$user_name,
		$pet_id,
		$comment
	);
	if($stm->execute($values) === FALSE) {
		return -1;
	}else{
		return $dbh->lastInsertId("comment_id");
	}
}

function getNumberOfImages() {
	try {
		$dbh = new PDO("sqlite:./petRescue.db");
	} catch (PDOException $e) {
		/* If you get here it is mostly a permissions issue
		* or that your path to the database is wrong
		*/
		echo 'Error: could not connect to database';
		die;
	}
	$img_num = $dbh->query("SELECT count(*)  FROM pet_images");
	return $img_num->fetchColumn();
}

function getImagePerPet() {
	try {
		$dbh = new PDO("sqlite:./petRescue.db");
	} catch (PDOException $e) {
		/* If you get here it is mostly a permissions issue
		* or that your path to the database is wrong
		*/
		echo 'Error: could not connect to database';
		die;
	}
	$sql = "SELECT * FROM pet_images";
	/*$sql = "SELECT * FROM pet_images WHERE image_id (SELECT MIN(image_id) FROM pet_images GROUP BY pet_id)";*/
	return $dbh->query($sql);
}

function getImage($image_id) {
	try {
		$dbh = new PDO("sqlite:./petRescue.db");
	} catch (PDOException $e) {
		/* If you get here it is mostly a permissions issue
		* or that your path to the database is wrong
		*/
		echo 'Error: could not connect to database';
		die;
	}
	$sql = "SELECT * FROM pet_images WHERE image_id ='$image_id'";
	return $dbh->query($sql)->fetch(); 
}

function getPetByImageId($image_id) {
	try {
		$dbh = new PDO("sqlite:./petRescue.db");
	} catch (PDOException $e) {
		/* If you get here it is mostly a permissions issue
		* or that your path to the database is wrong
		*/
		echo 'Error: could not connect to database';
		die;
	}

	$sql = "SELECT * FROM pet_images WHERE image_id ='$image_id'";
	$image = $dbh->query($sql)->fetch();
	$pet = $image["pet_id"];
	$sql = "SELECT * FROM pets WHERE pet_id ='$pet'";
	return $dbh->query($sql)->fetch();
}

function getCommentsForPet($pet_id) {
	try {
		$dbh = new PDO("sqlite:./petRescue.db");
	} catch (PDOException $e) {
		/* If you get here it is  mostly a permissions issue
		* or that your path to the database is wrong
		*/
		echo 'Error: could not connect to database';
		die;
	}

	$sql = "SELECT * FROM comments WHERE pet_id ='$pet_id'";
	return $dbh->query($sql)->fetch();
}

?>