<?php
/*
Name: Christian Guadalupe
Course: IT 202
Date: 02/11/2026
Assignment: IT-202 Phase 1 - Shirt Inventory Website
Email: cg546@njit.edu
*/
?>

<?php
session_start();

require_once('database.php');

$emailAddress = $_POST['email_address'];
$password = $_POST['password'];

$query = "SELECT email_address, pronouns, first_name, last_name, phone_number 
          FROM shirt_users 
          WHERE email_address = ? AND password = SHA2(?,256)";

$db = getDB();

$stmt = $db->prepare($query);
$stmt->bind_param("ss", $emailAddress, $password);
$stmt->execute();

$stmt->bind_result($emailAddress, $pronouns, $firstName, $lastName, $phoneNumber);
$fetched = $stmt->fetch();

$stmt->close();
$db->close();

if ($fetched) {

    $_SESSION['login'] = $firstName;

    $_SESSION['firstName'] = $firstName;
    $_SESSION['lastName'] = $lastName;
    $_SESSION['pronouns'] = $pronouns;
    $_SESSION['phoneNumber'] = $phoneNumber;
    $_SESSION['emailAddress'] = $emailAddress;

    header("Location: index.php");
    exit();
}

else {
    echo "<h2>Sorry, login incorrect for Shirt Inventory Website</h2>\n";
    echo '<a href="index.php">Please try again</a>\n';
}
?>