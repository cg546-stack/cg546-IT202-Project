<?php
error_log('$_POST ' . print_r($_POST, true));
require_once("shirt_type.php");

$shirtTypeID = $_POST['shirtTypeID'];

if (trim($shirtTypeID) == "" || !is_numeric($shirtTypeID)) {
    echo "<h2>Sorry, you must enter a valid shirt type ID</h2>\n";

} else if (ShirtType::findShirtType($shirtTypeID) == NULL) {
    echo "<h2>Sorry, a shirt type with ID $shirtTypeID does not exist</h2>\n";

} else {

    $shirttype = ShirtType::findShirtType($shirtTypeID);
    $result = $shirttype->removeShirtType();

    if ($result) {
        echo "<h2>Shirt Type $shirtTypeID removed</h2>\n";
    } else {
        echo "<h2>Sorry, problem removing shirt type $shirtTypeID</h2>\n";
    }
}
?>