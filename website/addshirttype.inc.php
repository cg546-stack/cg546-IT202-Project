<?php
/*
Name: Christian Guadalupe
Date: 03/11/2026
Course: IT-202-XXX Internet Applications
Assignment: Phase 1 - Shirt Inventory Website
Email: cg546@njit.edu
*/

require_once("shirt_type.php");

// Check if the user is logged in
if (isset($_SESSION['login'])) {

    // Only run this code AFTER the form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $shirtTypeID = $_POST['shirtTypeID'] ?? "";

        // Validate ID is not empty and is numeric
        if ((trim($shirtTypeID) == '') || (!is_numeric($shirtTypeID))) {
            echo "<h2>Sorry, you must enter a valid shirt type ID number</h2>\n";
        }

        // Check if ID already exists
        else if (ShirtType::findShirtType($shirtTypeID)) {
            echo "<h2>Sorry, a shirt type with the ID #$shirtTypeID already exists</h2>\n";
        }

        else {

            $shirtTypeCode = $_POST['shirtTypeCode'] ?? "";
            $shirtTypeName = $_POST['shirtTypeName'] ?? "";
            $shelfNumber = $_POST['shelfNumber'] ?? 0;

            $shirttype = new ShirtType(
                $shirtTypeID,
                $shirtTypeCode,
                $shirtTypeName,
                $shelfNumber
            );

            $result = $shirttype->saveShirtType();

            if ($result) {
                echo "<h2>New Shirt Type #$shirtTypeID successfully added</h2>\n";
            } 
            else {
                echo "<h2>Sorry, there was a problem adding that shirt type</h2>\n";
            }
        }

    } else {
        // Show the form when the page first loads
?>

<h2>Add New Shirt Type</h2>

<form method="post" action="index.php?content=addshirttype">

<label>Shirt Type ID:</label><br>
<input type="text" name="shirtTypeID"><br><br>

<label>Shirt Type Code:</label><br>
<input type="text" name="shirtTypeCode"><br><br>

<label>Shirt Type Name:</label><br>
<input type="text" name="shirtTypeName"><br><br>

<label>Shelf Number:</label><br>
<input type="text" name="shelfNumber"><br><br>

<input type="submit" value="Submit">

</form>

<?php
    }

} else {
    echo "<h2>Please log in first</h2>\n";
}
?>