<?php
/*
Name: Christian Guadalupe
Date: 02/11/2026
Course: IT-202 Internet Applications
Assignment: Phase 1 - Shirt Inventory Website
Email: cg546@njit.edu
*/

session_start();

require_once("shirt_type.php");
require_once("shirt.php");
?>

<!DOCTYPE html>
<html>

<head>
<title>Shirt Inventory Helper</title>
</head>

<body>

<header>
<?php include("header.inc.php"); ?>
</header>

<section style="display:flex; min-height:425px;">

<nav style="width:250px;">
<?php include("nav.inc.php"); ?>
</nav>

<main style="flex:1; padding-left:20px;">

<?php
if (isset($_REQUEST['content'])) {
    include($_REQUEST['content'] . ".inc.php");
}
else {
    include("main.inc.php");
}
?>

</main>

</section>

<footer style="margin-top:40px;">
<?php include("footer.inc.php"); ?>
</footer>

</body>
</html>