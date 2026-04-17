<?php
/*
Name: Christian Guadalupe
Date: 04/17/2026
Course: IT-202-XXX
Assignment: Phase 5 - AJAX
Email: cg546@njit.edu
*/
ob_start();
include("shirt_type.php");
include("shirt.php");

$totalShirtTypes = ShirtType::getTotalShirtTypes();
$totalShirts     = Shirt::getTotalShirts();
$totalBuyPrice   = Shirt::getTotalBuyPrice();
$totalSellPrice  = Shirt::getTotalSellPrice();

$doc = new DOMDocument("1.0");
$inventoryElement = $doc->createElement("inventory");
$inventoryElement = $doc->appendChild($inventoryElement);

$shirtTypesElement = $doc->createElement("shirttypes", $totalShirtTypes);
$shirtTypesElement = $inventoryElement->appendChild($shirtTypesElement);

$shirtsElement = $doc->createElement("shirts", $totalShirts);
$shirtsElement = $inventoryElement->appendChild($shirtsElement);

$buyPriceTotalElement = $doc->createElement("buypricetotal", $totalBuyPrice);
$buyPriceTotalElement = $inventoryElement->appendChild($buyPriceTotalElement);

$sellPriceTotalElement = $doc->createElement("sellpricetotal", $totalSellPrice);
$sellPriceTotalElement = $inventoryElement->appendChild($sellPriceTotalElement);

$output = $doc->saveXML();
header("Content-type: application/xml");
ob_end_clean();
echo $output;
?>