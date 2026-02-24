<?php
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