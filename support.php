<?php

class User {
	public $userName = '';/*  */
	public $hash = '';/* Hash of password */

	public function __construct($userName, $hash) {
		$this->userName = $userName;
		$this->hash = $hash;
	}
	public function contents() {
		$vals = array_values(get_object_vars($this));
		return array_reduce($vals, create_function('$a,$b','return is_null($a) ? "$b" : "$a".","."$b";'));
	}
	public function headings() {
		$vals = array_keys(get_object_vars($this));
		return array_reduce($vals, create_function('$a,$b','return is_null($a) ? "$b" : "$a".","."$b";'));
	}
}

function setupDefaultUsers() {
	$users = array();
	$i = 0;
	$users[$i++] = new User('ct310', '0ce8131d18aea4107081014d1e006627');//pass is $2a$10$oFNR0YCkkeE9BxCknANkbeBYPU0UmVI.WzW6aC4gc.pwhJcfdzCTG
	$users[$i++] = new User('greg', '6cc1b9419c7ff756978c0eab8ed06655');//pass is greg
	$users[$i++] = new User('jake', 'a7793d6ca120337495fd7d4d377f2440');//pass is jake
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
			$u = new User('','');
			for ($k = 0; $k < count($vals); $k++) {
				$u->$keys[$k] = $vals[$k];
			}
			$users[$i++] = $u;
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
	return md5($salt . $pass);
}
?>