<?php

if (!isset($_POST['shirtTypeID']) || !is_numeric($_POST['shirtTypeID'])) {
?>

<h2>You did not select a valid shirt type to view.</h2>
<a href="index.php?content=listshirttypes">List Shirt Types</a>

<?php
} else {

    $shirtTypeID = $_POST['shirtTypeID'];

    require_once("database.php");

    $db = getDB();

    $query = "SELECT *
              FROM shirts
              WHERE shirt_type_id = $shirtTypeID";

    $result = $db->query($query);

    if ($result && $result->num_rows > 0) {
?>

<br><br>
<b>Shirts:</b><br>

<table border="1">

<tr>
<th>ID</th>
<th>Code</th>
<th>Name</th>
<th>Description</th>
<th>Fabric</th>
<th>Fit</th>
<th>Type ID</th>
<th>Buy Price</th>
<th>Sell Price</th>
</tr>

<?php

$total = 0;

while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

?>

<tr>
<td><?php echo $row['shirt_id']; ?></td>
<td><?php echo $row['shirt_code']; ?></td>
<td><?php echo $row['shirt_name']; ?></td>
<td><?php echo $row['shirt_description']; ?></td>
<td><?php echo $row['fabric_type']; ?></td>
<td><?php echo $row['fit']; ?></td>
<td><?php echo $row['shirt_type_id']; ?></td>
<td><?php echo $row['buy_price']; ?></td>
<td><?php echo $row['sell_price']; ?></td>
</tr>

<?php

$total = $total + $row['sell_price'];

}

?>

<tr>
<td colspan="8"><b>Total Sell Price</b></td>
<td><?php echo '$' . number_format($total, 2); ?></td>
</tr>

</table>

<?php
    } else {
        echo "<h2>No shirts found for this shirt type</h2>";
    }

    $db->close();
}
?>