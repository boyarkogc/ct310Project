<?php

class Comment {
   public $userName = '';
   public $text = '';
   public $date = '';
   
	/* This function provides a complete comma delimeted dump of the contents/values of an object */
	public function contents() {
		$vals = array_values(get_object_vars($this));
		return(array_reduce($vals, create_function('$a,$b','return is_null($a) ? "$b" : "$a".","."$b";')));
	}
	/* Companion to contents, dumps heading/member names in tab delimeted format */
	public function headings() {
		$vals = array_keys(get_object_vars($this));
		return( array_reduce($vals, create_function('$a,$b','return is_null($a) ? "$b" : "$a".","."$b";')));
	}
}

function newComment($userName, $text, $date) {
	$comment = new Comment();
	$comment->userName = $userName;
	$comment->text = $text;
	$comment->date = $date;
	return $comment;
}

function writeComment($c) {
	if (!file_exists($_SESSION['page'] . '.csv')) { writeHeading(); }
	$fh = fopen($_SESSION['page'] . '.csv', 'a') or die("Can't open comment file for " . $_SESSION['page']);
	fwrite($fh, $c->contents() . "\n");
	fclose($fh);
}

function writeHeading() {
	$fh = fopen($_SESSION['page'] . '.csv', 'w+') or die("Can't open comment file for " . $_SESSION['page']);
	$c = new Comment();
	fwrite($fh, $c->headings() . "\n");
	fclose($fh);
}

function readComments() {
	if (!file_exists($_SESSION['page'] . '.csv')) { writeHeading(); }
	$contents = file_get_contents($_SESSION['page'] . '.csv');
	$lines    = preg_split("/\r|\n/", $contents, -1, PREG_SPLIT_NO_EMPTY);
	$keys     = preg_split("/,/", $lines[0]);
	$i        = 0;
	$comments = (array) null;//This prevents $comments from being undefined if no values happen to get pushed onto it
	for ($j = 1; $j < count($lines); $j++) {
		$vals = preg_split("/,/", $lines[$j]);
		if (count($vals) > 1) {
			$c = new Comment();
			for ($k = 0; $k < count($vals); $k++) {
				$c->$keys[$k] = $vals[$k];
			}
			$comments[$i] = $c;
			$i++;
		}
	}
	return $comments;
}

?>
