<?php
/*
Name: Christian Guadalupe
Date: 02/11/2026
Course: IT-202 Internet Applications
Assignment: Phase 5 - JavaScript
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
<link rel="stylesheet" href="styles.css">
<link rel="icon" href="images/logo.png">
<script src="realtime.js"></script>
</head>

<body>

<header>
<?php include("header.inc.php"); ?>
</header>

<section>

<nav>
<?php include("nav.inc.php"); ?>
</nav>

<main>
<?php
if (isset($_REQUEST['content'])) {
    include($_REQUEST['content'] . ".inc.php");
} else {
    include("main.inc.php");
}
?>
</main>

<?php if (isset($_SESSION['login'])) { ?>
<aside>
    <?php include("aside.inc.php"); ?>
    <script>
        getRealTime();
        setInterval(getRealTime, 5000);
    </script>
</aside>
<?php } ?>

</section>

<footer>
<?php include("footer.inc.php"); ?>
</footer>

</body>
</html>