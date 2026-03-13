<?php
/*
Name: Christian Guadalupe
Date: 02/24/2026
Course: IT-202-XXX Internet Applications
Assignment: Phase 1 - Shirt Inventory Website
Email: cg546@njit.edu
*/
require_once('shirt.php');

$shirtID = $_POST['shirtID'];

// validate ID
if ((trim($shirtID) == '') || (!is_numeric($shirtID))) {
    echo "<h2>Sorry, you must enter a valid shirt ID</h2>\n";
}

// check if exists
else if (!Shirt::findShirt($shirtID)) {
    echo "<h2>Sorry, A shirt with ID #$shirtID does not exist</h2>\n";
}

// remove
else {
    $shirt = Shirt::findShirt($shirtID);
    $result = $shirt->removeShirt();

    if ($result)
        echo "<h2>Shirt $shirtID removed</h2>\n";
    else
        echo "<h2>Sorry, problem removing shirt $shirtID</h2>\n";
}
?>