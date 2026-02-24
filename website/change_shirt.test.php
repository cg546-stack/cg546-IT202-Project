<?php
require_once('shirt.php');

$shirtID = $_POST['shirtID'];

if ((trim($shirtID) == '') || (!is_numeric($shirtID))) {
    echo "<h2>Sorry, you must enter a valid shirt ID</h2>\n";
} else if (!Shirt::findShirt($shirtID)) {
    echo "<h2>Sorry, A shirt with ID #$shirtID does not exist</h2>\n";
} else {
    $shirt = Shirt::findShirt($shirtID);

    $shirt->shirtID = $_POST['shirtID'];
    $shirt->shirtCode = $_POST['shirtCode'];
    $shirt->shirtName = $_POST['shirtName'];
    $shirt->shirtDescription = $_POST['shirtDescription'];
    $shirt->fabricType = $_POST['fabricType'];
    $shirt->fit = $_POST['fit'];
    $shirt->shirtTypeID = !empty($_POST['shirtTypeID']) ? $_POST['shirtTypeID'] : NULL;
    $shirt->buyPrice = $_POST['buyPrice'];
    $shirt->sellPrice = $_POST['sellPrice'];

    $result = $shirt->updateShirt();

    if ($result) {
        echo "<h2>Shirt $shirtID updated</h2>\n";
    } else {
        echo "<h2>Problem updating shirt $shirtID</h2>\n";
    }
}
?>