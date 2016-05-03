<?php
    header('Content-Type: text/json');

    if (isset($_GET['pet_id'])) {
        $id = $_GET['pet_id'];

        try{
            $dbh = new PDO("sqlite:doghouse.db");
        } catch(PDOException $e) {
            echo 'Connection failed. Error: ' . $e->getMessage();
        }
        $sql = "SELECT longText FROM Pets WHERE pet_id = '$id'";
        $result = $dbh->query($sql)->fetch();
        $desc = $result['longText'];

        $status = Array("description" => "$desc");

        echo json_encode($status);
        exit;
    }else {
        die();
    }
?>