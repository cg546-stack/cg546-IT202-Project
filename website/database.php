<?php
/*
Name: Christian Guadalupe
Date: 02/11/2026
Course: IT-202-XXX Internet Applications
Assignment: Phase 1 - Shirt Inventory Website
Email: cg546@njit.edu
*/
function getDB($echo_mode = false) {
    $host = 'localhost';
    $port = 3306;
    $dbname = 'shirt';
    $username = 'shirt_user';
    $password = 'shirt123!';

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    try {
        $db = new mysqli($host, $username, $password, $dbname, $port);
        if ($echo_mode) echo "Database connection successful to " . $host;
        return $db;
    } catch (mysqli_sql_exception $e) {
        if ($echo_mode) echo "Database connection failed: " . $e->getMessage();
        return null;
    }
}
//getDB(true);
?>