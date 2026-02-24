<?php
/*
Name: Christian Guadalupe
Date: 02/11/2026
Course: IT-202-XXX Internet Applications
Assignment: Phase 1 - Shirt Inventory Website
Email: cg546@njit.edu
*/

session_start();

if (isset($_SESSION['login'])) {
    unset($_SESSION['login']);
    session_destroy();
}

header("Location: index.php");
exit();
?>