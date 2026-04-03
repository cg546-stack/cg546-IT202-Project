<?php
/*
Name: Christian Guadalupe
Date: 03/11/2026
Course: IT-202-XXX
Assignment: Phase 2
*/
require_once("shirt_type.php");

// Fetching shirt types using ShirtType class
$shirtTypes = ShirtType::getShirtTypes();

if ($shirtTypes) {
?>
    <h2>List Shirt Types</h2>
    <table border="1" cellpadding="5">
        <tr>
            <th>Shirt Type ID</th>
            <th>Shirt Type Code</th>
            <th>Shirt Type Name</th>
            <th>Shelf Number</th>
        </tr>
        <?php
        foreach ($shirtTypes as $shirtType) {
            echo "<tr>";
            echo "<td>" . $shirtType->shirtTypeID . "</td>";
            echo "<td>" . $shirtType->shirtTypeCode . "</td>";
            echo "<td>" . $shirtType->shirtTypeName . "</td>";
            echo "<td>" . $shirtType->shelfNumber . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
<?php
} else {
    echo "<h2>No Shirt Types found.</h2>";
}
?>