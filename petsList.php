<?php
    header('Content-Type: text/json'); 

    $full_url = "http://" . $_SERVER['SERVER_NAME'];

    try{
        $dbh = new PDO("sqlite:doghouse.db");
    } catch(PDOException $e) {
        echo 'Connection failed. Error: ' . $e->getMessage();
    }

    $sql = "SELECT name,age,pet_id FROM Pets";

    foreach ($dbh->query($sql) as $row){
        $petName = $row['name'];
        $petKind = "Dog";//hardcoded in temporarily
        $breed = "Boxer";//hardcoded in temporarily
        $datePosted = "1/1/1900";//hardcoded in temporarily

        $pictureSQL = "SELECT pictureName FROM PetPictures WHERE pet_id='$petID' LIMIT 1";
        $pictureFileName = $dbh->query($pictureSQL)->fetchColumn();

        $petID = $row['pet_id'];
        $descURL = 'dogs.php?pet_id=$petID';
        $picture = "SELECT pictureName FROM PetPictures WHERE pet_id='$petID' LIMIT 1";
        $pictureFileName = $dbh->query($picture)->fetchColumn();
        echo "<img class='thumbnails' src='images/" . $pictureFileName . "' width='300' height='300'/>";  
    }

    echo json_encode($Status);
?>