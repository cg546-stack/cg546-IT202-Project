<?php
session_start();

error_log('$POST: ' . print_r($_POST, true));

require_once('database.php');

$emailAddress = $_POST['email_address'];
$password = $_POST['password'];

$query = "SELECT first_name, last_name, pronouns, phone_number 
          FROM shirt_users 
          WHERE email_address = ? AND password = SHA2(?, 256)";

$db = getDB();

$stmt = $db->prepare($query);
$stmt->bind_param("ss", $emailAddress, $password);
$stmt->execute();

$stmt->bind_result($firstName, $lastName, $pronouns, $phoneNumber);
$fetched = $stmt->fetch();

$stmt->close();
$db->close();

$name = "$firstName $lastName";

if ($fetched && isset($name)) {
    $_SESSION['login'] = true;
    $_SESSION['firstName'] = $firstName;
    $_SESSION['lastName'] = $lastName;
    $_SESSION['pronouns'] = $pronouns;
    $_SESSION['phoneNumber'] = $phoneNumber;
    $_SESSION['emailAddress'] = $emailAddress;

    header("Location: main.inc.php");
    exit();
} else {
    echo "<h2>Sorry, login incorrect for the Shirt Inventory Website</h2>\n";
    echo "<a href='index.php'>Please try again</a>\n";
}
?>