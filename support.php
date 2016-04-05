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

	$sql = "CREATE TABLE users (user_name VARCHAR(15) PRIMARY KEY, hash CHAR(255), 
		first_name VARCHAR(20), middle_name VARCHAR(20), last_name VARCHAR(20), 
		phone_number CHAR(12), email VARCHAR(40), owned_dogs BOOLEAN, owned_cats BOOLEAN, owned_turtles BOOLEAN,
		foster_interest BOOLEAN, has_pet_to_foster BOOLEAN, foster_explanation VARCHAR(500))";
	$status = $dbh->exec($sql);
	if($status === FALSE){
		echo 'Error encountered setting up users table';
	}

	$sql = "CREATE TABLE pets (pet_name VARCHAR(20) PRIMARY KEY, pet_type VARCHAR(6), summary VARCHAR(50), details VARCHAR(500), weight INTEGER)";
	$status = $dbh->exec($sql);
	if($status === FALSE){
		echo 'Error encountered setting up pets table';
	}

	$sql = "CREATE TABLE comments (comment_id INTEGER PRIMARY KEY ASC, user_name VARCHAR(15), pet_name VARCHAR(20), 
		comment_text VARCHAR(2000), FOREIGN KEY(user_name) REFERENCES users(user_name), FOREIGN KEY(pet_name) REFERENCES pets(pet_name))";
	$status = $dbh->exec($sql);
	if($status === FALSE) {
		echo 'Error encountered setting up comments table';
	}

	$sql = "CREATE TABLE pet_images (image_id INTEGER PRIMARY KEY ASC, pet_name VARCHAR(20), 
		name varchar(50), type varchar(50), size int(10), ext varchar(5), FOREIGN KEY(pet_name) REFERENCES pets(pet_name))";
	$status = $dbh->exec($sql);
	if($status === FALSE){
		echo 'Error encountered setting up images table';
	}
}

function readUsers() {

}

function userHashByName() {

}
?>