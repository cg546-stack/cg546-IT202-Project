<?php
/*
Name: Christian Guadalupe
Date: 02/24/2026
Course: IT-202-XXX Internet Applications
Assignment: Phase 1 - Shirt Inventory Website
Email: cg546@njit.edu
*/
require_once('shirt.php');

// Fetching all shirts from the database
$shirts = Shirt::getShirts(); 

if ($shirts) {
?>
    <h2>Select Shirt</h2>
    <form name="shirts" method="post">
        <select name="shirtID" size="20">
            <?php
            $first = true;
            foreach ($shirts as $shirt) {
                // Property names must match your Shirt class exactly
                $shirtID = $shirt->shirtID;
                $shirtName = $shirt->shirtName;
                $price = $shirt->sellPrice;

                $option = $shirtID . " - " . $shirtName . " - $" . $price;

                if ($first) {
                    echo "<option value=\"$shirtID\" selected>$option</option>\n";
                    $first = false;
                } else {
                    echo "<option value=\"$shirtID\">$option</option>\n";
                }
            }
            ?>
        </select>
    </form>
<?php
} else {
    echo "<h2>No shirts found.</h2>";
}
?>