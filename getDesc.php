<?php
	header('Content-Type: text/json'); 
	$Dog = $_SERVER['QUERY_STRING'];
	
	try{
		$dbh = new PDO("sqlite:doghouse.db");
	} catch(PDOException $e) {
		echo 'Connection failed. Error: ' . $e->getMessage();
	}

	$sql = "SELECT pet_id,longText FROM Pets";
	$Status;
	foreach ($dbh->query($sql) as $row){
		$petid = "pet_id=". $row['pet_id'];
		if($petid == $Dog){
			$Status =  array("description" => $row['longText']);
		}       
	}
	echo json_encode($Status);
?>
