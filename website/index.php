<?php
/*
Name: Christian Guadalupe
Date: 02/11/2026
Course: IT-202-XXX Internet Applications
Assignment: Phase 1 - Shirt Inventory Website
Email: cg546@njit.edu
*/
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Shirt Inventory Website</title>
</head>
<body>
    <section>
        <main>
            <?php
                if (isset($_REQUEST['content'])) {
                    include($_REQUEST['content'] . ".inc.php");
                } else {
                    include("main.inc.php");
                }
            ?>
        </main>
    </section>
</body>
</html>