<?php

$host = "localhost";
$user = "cis_user";
$pass = "SenhaForte123!";
$db   = "cis_dashboard";

$conn = new mysqli($host,$user,$pass,$db);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

?>
