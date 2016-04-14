<?php
require_once 'lib/support.php';
require_once 'lib/config.php';

if (! isset ( $_GET ["image_id"] )) {
	die (); // Normally would return default image or shim
}

$imageRecord = getImage ( intval ( $_GET ["image_id"] ) );
if ($imageRecord === FALSE) {
	die ();
}

// open the file in a binary mode
$name = $config->upload_dir . str_pad ( $imageRecord ["image_id"], $config->pad_length, "0", STR_PAD_LEFT ) . "." . $imageRecord ["ext"];
$fp = fopen ( $name, 'rb' );

// send the right headers
$contentType = "Content-Type: " . $imageRecord ["type"];
header ( $contentType );
header ( "Content-Length: " . filesize ( $name ) );

// dump the picture and stop the script
fpassthru ( $fp );
exit ();
?>