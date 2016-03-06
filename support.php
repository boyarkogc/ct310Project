<?php

class User {
   public $userName = '';/*  */
   public $hash = '';/* Hash of password */
   
	/* This function provides a complete comma delimeted dump of the contents/values of an object */
	public function contents() {
		$vals = array_values(get_object_vars($this));
		return array_reduce($vals, create_function('$a,$b','return is_null($a) ? "$b" : "$a".","."$b";'));
	}
	/* Companion to contents, dumps heading/member names in tab delimeted format */
	public function headings() {
		$vals = array_keys(get_object_vars($this));
		return array_reduce($vals, create_function('$a,$b','return is_null($a) ? "$b" : "$a".","."$b";'));
	}
}

function newUser($userName, $hash) {
	$user = new User();
	$user->userName = $userName;
	$user->hash = $hash;
	return $user;
}

function setupDefaultUsers() {
	$users = array();
	$i = 0;
	//$users[$i++] = newUser('ct310', '');
	$users[$i++] = newUser('greg', '6cc1b9419c7ff756978c0eab8ed06655');//pass is greg
	$users[$i++] = newUser('jake', 'a7793d6ca120337495fd7d4d377f2440');//pass is jake
	writeUsers($users);
}

function writeUsers($users) {
	$fh = fopen('users.csv', 'w+') or die("Can't open users file");
	fwrite($fh, $users[0]->headings()."\n");
	for ($i = 0; $i < count($users); $i++) {
		fwrite($fh, $users[$i]->contents()."\n");
	}
	fclose($fh);
}

function readUsers() {
	if (!file_exists('users.csv')) { setupDefaultUsers(); }
	$contents = file_get_contents('users.csv');
	$lines    = preg_split("/\r|\n/", $contents, -1, PREG_SPLIT_NO_EMPTY);
	$keys     = preg_split("/,/", $lines[0]);
	$i        = 0;
	for ($j = 1; $j < count($lines); $j++) {
		$vals = preg_split("/,/", $lines[$j]);
		if (count($vals) > 1) {
			$u = new User();
			for ($k = 0; $k < count($vals); $k++) {
				$u->$keys[$k] = $vals[$k];
			}
			$users[$i] = $u;
			$i++;
		}
	}
	return $users;
}

function userHashByName($users, $userName) {
	$hash = '';
	foreach ($users as $u ) {
		if ($u->userName == $userName) {
			$hash = $u->hash;
		}
	}
	return $hash;
}

function salt($userName, $pass) {
	$salt = substr($userName, 1, 4);
	return md5($salt.$pass);
}

?>