<?php
require_once('shirt.php');

$items = Shirt::getShirts(); // or Shirt::getItems();

if ($items) {
    foreach ($items as $item) {
        $shirtID = $item->shirtID;
        $shirtName = $item->shirtName;
        $sellPrice = $item->sellPrice;

        $option = $shirtID . " - " . $shirtName . " - " . $sellPrice;
        echo "$option<br>";
    }
} else {
    echo "<h2>No shirts found.</h2>";
}
?>