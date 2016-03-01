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

function writeComments($comments) {
	$fh = fopen($page . '.csv', 'w+') or die("Can't open users file");
	fwrite($fh, $comments[0]->headings()."\n");
	for ($i = 0; $i < count($comments); $i++) {
		fwrite($fh, $comments[$i]->contents()."\n");
	}
	fclose($fh);
}

function addComment($c) {
	$fh = fopen($page . '.csv', 'a') or die("Can't open users file");
	fwrite($fh, $c . "\n");
	fclose($fh);
}

function readComments() {
	if (! file_exists($page . '.csv')) { setupDefaultUsers(); }
	$contents = file_get_contents($page . '.csv');
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
			$comments[$i] = $u;
			$i++;
		}
	}
	return $comments;
}

?>
