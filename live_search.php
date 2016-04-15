<?php
require_once 'lib/support.php';

$q=$_GET["q"];

if (strlen($q) > 0) {
    $suggestions = "";
    $pets = petSearchListing($q);
    foreach ($pets as $pet) {
        $image_ids = getImageIdsByPetName($pet['pet_name']);
        foreach ($image_ids as $id) {
            //echo "hi";
            //echo $id['image_id'] . "\n";
            $suggestions = $suggestions . "<a href=pet.php?image_id=" . $id['image_id'] . ">" . $pet['pet_name'] . "</a><br>";
        }
    }
}

if ($suggestions=="") {
    $response="No pets match your query";
} else {
    $response=$suggestions;
}

echo $response;
?>