<?php

include("config/db.php");

$agent  = $_POST['agent'];
$ip     = $_POST['ip'];
$passed = $_POST['passed'];
$failed = $_POST['failed'];
$na     = $_POST['na'];
$score  = $_POST['score'];

$sql = "INSERT INTO hosts (agent,ip,passed,failed,na_checks,score)
VALUES ('$agent','$ip','$passed','$failed','$na','$score')";

$conn->query($sql);

header("Location: dashboard.php");

?>
