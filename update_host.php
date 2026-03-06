<?php

include("config/db.php");

$id = $_POST['id'];

$agent = $_POST['agent'];
$ip = $_POST['ip'];
$passed = $_POST['passed'];
$failed = $_POST['failed'];
$na = $_POST['na'];
$score = $_POST['score'];

$sql = "UPDATE hosts SET

agent='$agent',
ip='$ip',
passed='$passed',
failed='$failed',
na_checks='$na',
score='$score'

WHERE id=$id";

$conn->query($sql);

header("Location: hosts.php");

?>
