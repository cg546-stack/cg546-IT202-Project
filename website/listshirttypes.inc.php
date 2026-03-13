<?php
/*
Name: Christian Guadalupe
Date: 03/11/2026
Course: IT-202-XXX
Assignment: Phase 2
*/
require_once("shirt.php");

// Fetching shirts using your Shirt class
$shirts = Shirt::getShirts();

if ($shirts) {
?>
    <h2>Select Shirt</h2>
    <form name="shirts" method="post">
        <select name="shirtID" size="20">
            <?php
            $first = true;

            foreach ($shirts as $shirt) {
                // Mapping to your database column names (assuming standard naming)
                $shirtID = $shirt->shirtID;
                $shirtName = $shirt->shirtName;
                $shirtPrice = $shirt->price;

                $option = $shirtID . " - " . $shirtName . " - $" . $shirtPrice;

                if ($first) {
                    // Fixed the quotes here so PHP doesn't get confused
                    echo "<option value='$shirtID' selected>$option</option>\n";
                    $first = false;
                } else {
                    echo "<option value='$shirtID'>$option</option>\n";
                }
            }
            ?>
        </select>
    </form>
<?php
} else {
    echo "<h2>No Shirts found.</h2>";
}
?>