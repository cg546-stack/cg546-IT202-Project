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

    // 1.5 - filter_input() on numeric field
    $shirtID = filter_input(INPUT_POST, 'shirtID', FILTER_SANITIZE_NUMBER_INT);

    // Step 2: Validate the Shirt ID
    if ((trim($shirtID) == '') || (!is_int((int)$shirtID))) {
        echo "<h2>Sorry, you must enter a valid shirt ID number</h2>\n";
    }

    // Step 3: Check if shirt already exists
    else if (Shirt::findShirt($shirtID)) {
        echo "<h2>Sorry, a shirt with the ID #$shirtID already exists</h2>\n";
    }

    else {

        // Step 4: Capture form data
        // 1.5 - check raw price first, then filter
        $rawPrice = $_POST['price'] ?? '';
        if (!is_numeric($rawPrice)) {
            echo "<h2>Sorry, price must be a valid number</h2>\n";
        } else {

            // 1.5 - filter_input() on numeric fields
            $shirtTypeID = filter_input(INPUT_POST, 'shirtTypeID', FILTER_SANITIZE_NUMBER_INT);
            $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

            // 1.4 - htmlspecialchars() on non-numeric text fields to prevent XSS
            $shirtCode = htmlspecialchars($_POST['shirtCode'] ?? "", ENT_QUOTES, 'UTF-8');
            $shirtName = htmlspecialchars($_POST['shirtName'] ?? "", ENT_QUOTES, 'UTF-8');
            $description = htmlspecialchars($_POST['description'] ?? "", ENT_QUOTES, 'UTF-8');

            // 1.5 - Validate numeric fields with is_int() and is_float()
            if (!is_int((int)$shirtTypeID)) {
                echo "<h2>Sorry, shirt type ID must be a valid number</h2>\n";
            } else if (!is_float((float)$price)) {
                echo "<h2>Sorry, price must be a valid number</h2>\n";
            } else {

                // Step 5: Create Shirt object
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
        }
    }

} else {
    echo "<h2>Please log in first</h2>\n";
}
?>