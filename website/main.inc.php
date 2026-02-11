<?php
session_start();

if (!isset($_SESSION['login'])) {
?>

<h2>Please Login to the Shirt Inventory Website</h2><br>

<form name="login" action="validate.inc.php" method="post">

    <label>Email:</label>
    <input type="text" name="email_address" size="20">
    <br><br>

    <label>Password:</label>
    <input type="password" name="password" size="20">
    <br><br>

    <input type="submit" value="Login">
    <input type="hidden" name="content" value="validate">

</form>

<?php
} else {
    echo "<h2>Welcome to the Shirt Inventory Website, {$_SESSION['firstName']} {$_SESSION['lastName']} ({$_SESSION['pronouns']})</h2>";
?>
<br><br>
<p>This program tracks shirt inventory</p>
<p>Please use the links in the navigation window</p>
<p>Please DO NOT use the browser navigation buttons!</p>
<a href="index.php?content=logout"><strong>Logout</strong></a>
<?php
}
?>