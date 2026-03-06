<?php

include("config/db.php");

$id = $_GET['id'];

$conn->query("DELETE FROM hosts WHERE id=$id");

header("Location: hosts.php");

?>
