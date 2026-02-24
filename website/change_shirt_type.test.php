<?php
require_once("shirt_type.php");

$shirtTypeID = $_POST['shirtTypeID'];

if (trim($shirtTypeID) == "" || !is_numeric($shirtTypeID)) {
    echo "<h2>Sorry, you must enter a valid shirt type ID</h2>\n";

} else if (ShirtType::findShirtType($shirtTypeID) == NULL) {
    echo "<h2>Sorry, a shirt type with ID $shirtTypeID does not exist</h2>\n";

} else {

    $shirttype = ShirtType::findShirtType($shirtTypeID);

    $shirttype->shirtTypeID = $_POST['shirtTypeID'];
    $shirttype->shirtTypeCode = $_POST['shirtTypeCode'];
    $shirttype->shirtTypeName = $_POST['shirtTypeName'];
    $shirttype->shelfNumber = $_POST['shelfNumber'];

    $result = $shirttype->updateShirtType();

    if ($result) {
        echo "<h2>Shirt Type $shirtTypeID updated</h2>\n";
    } else {
        echo "<h2>Problem updating shirt type $shirtTypeID</h2>\n";
    }
}
?>