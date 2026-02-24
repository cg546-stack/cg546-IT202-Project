<?php
require_once("shirt_type.php");

$shirtTypeID = $_POST['shirtTypeID'];

if (trim($shirtTypeID) == "" || !is_numeric($shirtTypeID)) {
    echo "<h2>Sorry, you must enter a valid shirt type ID number</h2>\n";

} else if (ShirtType::findShirtType($shirtTypeID) != NULL) {
    echo "<h2>Sorry, a shirt type with ID $shirtTypeID already exists</h2>\n";

} else {

    $shirtTypeCode = $_POST['shirtTypeCode'];
    $shirtTypeName = $_POST['shirtTypeName'];
    $shelfNumber = $_POST['shelfNumber'];

    if (trim($shelfNumber) == "" || !is_numeric($shelfNumber)) {
        echo "<h2>Sorry, you must enter a valid shelf number</h2>\n";
    } else {
        $shirttype = new ShirtType(
            $shirtTypeID,
            $shirtTypeCode,
            $shirtTypeName,
            $shelfNumber
        );

        $result = $shirttype->saveShirtType();

        if ($result) {
            echo "<h2>New Shirt Type $shirtTypeID successfully added</h2>\n";
        } else {
            echo "<h2>Sorry, there was a problem adding that shirt type</h2>\n";
        }
    }
}
?>