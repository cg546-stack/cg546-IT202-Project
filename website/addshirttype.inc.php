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

        // 1.3 - filter_input() on numeric field
        $shirtTypeID = filter_input(INPUT_POST, 'shirtTypeID', FILTER_SANITIZE_NUMBER_INT);

        // 1.3 - Validate ID is not empty and is_int()
        if ((trim($shirtTypeID) == '') || (!is_int((int)$shirtTypeID))) {
            echo "<h2>Sorry, you must enter a valid shirt type ID number</h2>\n";
        }

        // Check if ID already exists
        else if (ShirtType::findShirtType($shirtTypeID)) {
            echo "<h2>Sorry, a shirt type with the ID #$shirtTypeID already exists</h2>\n";
        }

        else {

            // 1.2 - htmlspecialchars() added to text fields to prevent XSS
            $shirtTypeCode = htmlspecialchars($_POST['shirtTypeCode'] ?? "", ENT_QUOTES, 'UTF-8');
            $shirtTypeName = htmlspecialchars($_POST['shirtTypeName'] ?? "", ENT_QUOTES, 'UTF-8');
            
            // 1.3 - filter_input() on numeric field + is_int() validation
            $shelfNumber = filter_input(INPUT_POST, 'shelfNumber', FILTER_SANITIZE_NUMBER_INT);

            if (!is_int((int)$shelfNumber)) {
                echo "<h2>Sorry, shelf number must be a valid number</h2>\n";
            } else {

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
        }

    } else {
        // Show the form when the page first loads
?>

<h2>Add New Shirt Type</h2>

<form method="post" action="index.php?content=addshirttype">

<label>Shirt Type ID:</label><br>
<!-- 2.1 - number input, not blank, min/max range -->
<input type="number" name="shirtTypeID" required min="1" max="9999"><br><br>

<label>Shirt Type Code:</label><br>
<!-- 2.1 - not blank, min 2 chars, max 10 chars -->
<input type="text" name="shirtTypeCode" required minlength="2" maxlength="10"><br><br>

<label>Shirt Type Name:</label><br>
<!-- 2.1 - not blank, min 10 chars, max 100 chars -->
<input type="text" name="shirtTypeName" required minlength="10" maxlength="100"><br><br>

<label>Shelf Number:</label><br>
<!-- 2.1 - number input, not blank, min/max range -->
<input type="number" name="shelfNumber" required min="1" max="999"><br><br>

<input type="submit" value="Submit">

</form>

<?php
    }

} else {
    echo "<h2>Please log in first</h2>\n";
}
?>