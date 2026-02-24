<?php
require_once("shirt_type.php");

$shirttypes = ShirtType::getShirtTypes();

if ($shirttypes) {
    foreach ($shirttypes as $shirttype) {
        $line = $shirttype->shirtTypeID . " - " .
                $shirttype->shirtTypeCode . ", " .
                $shirttype->shirtTypeName . " (Shelf: " .
                $shirttype->shelfNumber . ")";
        echo $line . "<br>";
    }
} else {
    echo "<h2>No shirt types found.</h2>";
}
?>