<?php
    header('Content-Type: text/json'); 
    class DOG{
	public $petName;
	public $petKind;
	public $breed;
	public $datePosted;
	public $imageURL;
	public $petId;
	public $descURL;
    }

    $host = $_SERVER['HTTP_HOST'];
    $uri = rtrim (dirname($_SERVER['PHP_SELF']), '/\\');
    $base_url = "http://$host$uri";

    try{
        $dbh = new PDO("sqlite:doghouse.db");
    } catch(PDOException $e) {
        echo 'Connection failed. Error: ' . $e->getMessage();
    }

    $sql = "SELECT name,age,pet_id,breed,datePosted,typeOfPet FROM Pets";
	$stat;
    foreach ($dbh->query($sql) as $row){
        $status = new DOG();
        $status->petName = $row['name'];
        $status->petKind = $row['typeOfPet'];
        $status->breed = $row['breed'];
        $status->datePosted = $row['dateposted'];
        $status->petId = $row['pet_id'];

        $pictureSQL = "SELECT pictureName FROM PetPictures WHERE pet_id='$row[pet_id]' LIMIT 1";
        $pictureFileName = $dbh->query($pictureSQL)->fetchColumn();
        $status->imageURL = $base_url . "/getImage.php/?image=" . $pictureFileName; 

        $status->descURL = $base_url . "/getDesc.php?pet_id=" . $row['pet_id'];
	$stat[] = $status;
}

        echo json_encode($stat);
?>