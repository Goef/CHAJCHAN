<?php

include('config.php');
include('account.php');

$email      = $_POST['email'];
$password   = $_POST['password'];
$username   = $_POST['username'];
$name       = $_POST['name'];


$sql = "INSERT INTO users (email, pwd, username, name)
        VALUES ($email, $password, $username, $name)";

if ($db->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $db->error;
}

$db->close();
?>