<?php
/*
Name: Christian Guadalupe
Date: 03/11/2026
Course: IT-202-XXX Internet Applications
Assignment: Phase 1 - Shirt Inventory Website
Email: cg546@njit.edu
*/

require_once('shirt.php');

// Step 1: Check if the user is logged in
if (isset($_SESSION['login'])) {

    $shirtID = $_POST['shirtID'];

    // Step 2: Validate the Shirt ID
    if ((trim($shirtID) == '') || (!is_numeric($shirtID))) {
        echo "<h2>Sorry, you must enter a valid shirt ID number</h2>\n";
    }

    // Step 3: Check if shirt already exists
    else if (Shirt::findShirt($shirtID)) {
        echo "<h2>Sorry, a shirt with the ID #$shirtID already exists</h2>\n";
    }

    else {

        // Step 4: Capture form data
        $shirtTypeID = $_POST['shirtTypeID'];
        $shirtCode = $_POST['shirtCode'];
        $shirtName = $_POST['shirtName'];
        $description = $_POST['description'];
        $price = $_POST['price'];

        // Step 5: Create Shirt object
        // (Must match the 9 parameters required in shirt.php)
        $shirt = new Shirt(
            $shirtID,
            $shirtCode,
            $shirtName,
            $description,
            "cotton",     // fabricType default
            "regular",    // fit default
            $shirtTypeID,
            $price,       // buyPrice
            $price        // sellPrice
        );

        // Step 6: Save to database
        $result = $shirt->saveShirt();

        if ($result) {
            echo "<h2>New Shirt #$shirtID successfully added</h2>\n";
        } else {
            echo "<h2>Sorry, there was a problem adding that shirt</h2>\n";
        }
    }

} else {
    echo "<h2>Please log in first</h2>\n";
}
?>