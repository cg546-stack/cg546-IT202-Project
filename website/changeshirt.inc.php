<?php
/*
Name: Christian Guadalupe
Date: 03/11/2026
Course: IT-202-XXX Internet Applications
Assignment: Phase 1 - Shirt Inventory Website
Email: cg546@njit.edu
*/
require_once('shirt.php');

if (isset($_SESSION['login'])) {
    $answer = $_POST['answer'];
    $shirtID = $_POST['shirtID'];
    if ($answer == "Update Shirt") {
        $shirtCode = $_POST['shirtCode'];
        $shirtName = $_POST['shirtName'];
        $shirtDescription = $_POST['shirtDescription'];
        $fabricType = $_POST['fabricType'];
        $fit = $_POST['fit'];
        $shirtTypeID = $_POST['shirtTypeID'];
        $buyPrice = $_POST['buyPrice'];
        $sellPrice = $_POST['sellPrice'];

        $shirt = Shirt::findShirt($shirtID);
        $shirt->shirtCode = $shirtCode;
        $shirt->shirtName = $shirtName;
        $shirt->shirtDescription = $shirtDescription;
        $shirt->fabricType = $fabricType;
        $shirt->fit = $fit;
        $shirt->shirtTypeID = $shirtTypeID;
        $shirt->buyPrice = $buyPrice;
        $shirt->sellPrice = $sellPrice;

        $result = $shirt->updateShirt();
        if ($result) {
            echo "<h2>Shirt $shirtID was successfully updated</h2>\n";
        } else {
            echo "<h2>Error: Could not update shirt $shirtID</h2>\n";
        }
    } else {
        echo "<h2>Update for shirt $shirtID was cancelled</h2>\n";
    }
} else {
    echo "<h2>Please log in first</h2>\n";
}
?>