Here is your full file with HTML validation added for 2.2:
php<?php
/*
Name: Christian Guadalupe
Date: 03/11/2026
Course: IT-202 Internet Applications
Section: XXX
Assignment: Phase 3 - Shirt Inventory Website
Email: cg546@njit.edu
*/
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
<!-- 1.6 - htmlspecialchars() on text fields to prevent XSS -->
<!-- 2.2 - not blank, min 2 chars, max 10 chars -->
<input type="text" name="shirtCode" required minlength="2" maxlength="10" value="<?php echo htmlspecialchars($shirt->shirtCode, ENT_QUOTES, 'UTF-8'); ?>">
</td>
</tr>

<tr>
<td>Shirt Name</td>
<td>
<!-- 1.6 - htmlspecialchars() on text fields to prevent XSS -->
<!-- 2.2 - not blank, min 10 chars, max 100 chars -->
<input type="text" name="shirtName" required minlength="10" maxlength="100" value="<?php echo htmlspecialchars($shirt->shirtName, ENT_QUOTES, 'UTF-8'); ?>">
</td>
</tr>

<tr>
<td>Description</td>
<td>
<!-- 1.6 - htmlspecialchars() on text fields to prevent XSS -->
<!-- 2.2 - not blank, min 100 chars, max 255 chars -->
<input type="text" name="shirtDescription" required minlength="100" maxlength="255" value="<?php echo htmlspecialchars($shirt->shirtDescription, ENT_QUOTES, 'UTF-8'); ?>">
</td>
</tr>

<tr>
<td>Fabric Type</td>
<td>
<!-- 1.6 - htmlspecialchars() on text fields to prevent XSS -->
<input type="text" name="fabricType" value="<?php echo htmlspecialchars($shirt->fabricType, ENT_QUOTES, 'UTF-8'); ?>">
</td>
</tr>

<tr>
<td>Fit</td>
<td>
<!-- 1.6 - htmlspecialchars() on text fields to prevent XSS -->
<input type="text" name="fit" value="<?php echo htmlspecialchars($shirt->fit, ENT_QUOTES, 'UTF-8'); ?>">
</td>
</tr>

<tr>
<td>Shirt Type ID</td>
<td>
<!-- 2.2 - number input, not blank, min/max range -->
<input type="number" name="shirtTypeID" required min="1" max="9999" value="<?php echo $shirt->shirtTypeID; ?>">
</td>
</tr>

<tr>
<td>Buy Price</td>
<td>
<!-- 2.2 - number input, not blank, allows decimals -->
<input type="number" name="buyPrice" required min="0" max="9999" step="0.01" value="<?php echo $shirt->buyPrice; ?>">
</td>
</tr>

<tr>
<td>Sell Price</td>
<td>
<!-- 2.2 - number input, not blank, allows decimals -->
<input type="number" name="sellPrice" required min="0" max="9999" step="0.01" value="<?php echo $shirt->sellPrice; ?>">
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