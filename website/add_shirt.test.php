<?php
require_once('shirt.php');

$shirtID = $_POST['shirtID'];

if ((trim($shirtID) == '') || (!is_numeric($shirtID))) {
    echo "<h2>Sorry, you must enter a valid shirt ID number</h2>\n";
}
else if (Shirt::findShirt($shirtID)) {
    echo "<h2>Sorry, A shirt with the ID #$shirtID already exists</h2>\n";
}
else {
    $shirtCode = $_POST['shirtCode'];
    $shirtName = $_POST['shirtName'];
    $shirtDescription = $_POST['shirtDescription'];
    $fabricType = $_POST['fabricType'];
    $fit = $_POST['fit'];

    $shirtTypeID = !empty($_POST['shirtTypeID']) ? $_POST['shirtTypeID'] : NULL;

    $buyPrice = $_POST['buyPrice'];
    $sellPrice = $_POST['sellPrice'];

    $shirt = new Shirt(
        $shirtID,
        $shirtCode,
        $shirtName,
        $shirtDescription,
        $fabricType,
        $fit,
        $shirtTypeID,
        $buyPrice,
        $sellPrice
    );

    $result = $shirt->saveShirt();

    if ($result) {
        echo "<h2>New Shirt #$shirtID successfully added</h2>\n";
    } else {
        echo "<h2>Sorry, there was a problem adding that shirt</h2>\n";
    }
}
?>