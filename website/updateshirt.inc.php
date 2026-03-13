<?php
if (!isset($_POST['shirtID']) || !is_numeric($_POST['shirtID'])) {
?>

<h2>You did not select a valid shirt ID value</h2>
<a href="index.php?content=listshirts">List Shirts</a>

<?php
} else {

    $shirtID = $_POST['shirtID'];
    $shirt = Shirt::findShirt($shirtID);

    if ($shirt) {
?>

<h2>Update Shirt <?php echo $shirt->shirtID; ?></h2>

<form name="shirts" action="index.php" method="post">

<table>

<tr>
<td>Shirt ID</td>
<td><?php echo $shirt->shirtID; ?></td>
</tr>

<tr>
<td>Shirt Code</td>
<td>
<input type="text" name="shirtCode" value="<?php echo $shirt->shirtCode; ?>">
</td>
</tr>

<tr>
<td>Shirt Name</td>
<td>
<input type="text" name="shirtName" value="<?php echo $shirt->shirtName; ?>">
</td>
</tr>

<tr>
<td>Description</td>
<td>
<input type="text" name="shirtDescription" value="<?php echo $shirt->shirtDescription; ?>">
</td>
</tr>

<tr>
<td>Fabric Type</td>
<td>
<input type="text" name="fabricType" value="<?php echo $shirt->fabricType; ?>">
</td>
</tr>

<tr>
<td>Fit</td>
<td>
<input type="text" name="fit" value="<?php echo $shirt->fit; ?>">
</td>
</tr>

<tr>
<td>Shirt Type ID</td>
<td>
<input type="text" name="shirtTypeID" value="<?php echo $shirt->shirtTypeID; ?>">
</td>
</tr>

<tr>
<td>Buy Price</td>
<td>
<input type="text" name="buyPrice" value="<?php echo $shirt->buyPrice; ?>">
</td>
</tr>

<tr>
<td>Sell Price</td>
<td>
<input type="text" name="sellPrice" value="<?php echo $shirt->sellPrice; ?>">
</td>
</tr>

</table>

<br><br>

<input type="submit" name="answer" value="Update Shirt">
<input type="submit" name="answer" value="Cancel">

<input type="hidden" name="shirtID" value="<?php echo $shirt->shirtID; ?>">
<input type="hidden" name="content" value="changeshirt">

</form>

<?php
    } else {
?>

<h2>Sorry, shirt <?php echo $shirtID; ?> not found</h2>
<a href="index.php?content=listshirts">List Shirts</a>

<?php
    }
}
?>