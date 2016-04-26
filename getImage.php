<?php
header("Access-Control-Allow-Origin: *");
$fp = fopen("imageFileName.png", 'rb');
$str = file_get_contents($name, FILE_USE_INCLUDE_PATH);
echo base64_encode($str);
exit;
?>