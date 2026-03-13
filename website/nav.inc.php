<?php
if (isset($_SESSION['login'])) {
?>

<h3>Welcome, <?php echo $_SESSION['firstName']; ?></h3>

<p>
<a href="index.php?content=main">Home</a>
</p>

<b>Shirt Types</b>

<ul>
<li>
<a href="index.php?content=listshirttypes">List Shirt Types</a>
</li>

<li>
<a href="index.php?content=addshirttype">Add New Shirt Type</a>
</li>
</ul>

<b>Shirts</b>

<ul>
<li>
<a href="index.php?content=listshirts">List Shirts</a>
</li>

<li>
<a href="index.php?content=newshirt">Add New Shirt</a>
</li>
</ul>

<hr>

<p>
<a href="index.php?content=logout">Logout</a>
</p>

<form method="post" action="index.php?content=updateshirt">
<label>Search for Shirt:</label><br>
<input type="text" name="shirtID">
<input type="submit" value="Find">
</form>

<br>

<form method="post" action="index.php?content=displayshirttype">
<label>Search for Shirt Type:</label><br>
<input type="text" name="shirtTypeID">
<input type="submit" value="Find">
</form>

<?php
}
?>