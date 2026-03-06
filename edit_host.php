<?php

include("config/db.php");

$id = $_GET['id'];

$result = $conn->query("SELECT * FROM hosts WHERE id=$id");
$host = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html>

<head>

<title>Edit Host</title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

</head>

<body class="container mt-4">

<h2>Edit Host</h2>

<form action="update_host.php" method="POST">

<input type="hidden" name="id" value="<?= $host['id'] ?>">

Agent
<input class="form-control" type="text" name="agent"
value="<?= $host['agent'] ?>">

IP
<input class="form-control" type="text" name="ip"
value="<?= $host['ip'] ?>">

Passed
<input class="form-control" type="number" name="passed"
value="<?= $host['passed'] ?>">

Failed
<input class="form-control" type="number" name="failed"
value="<?= $host['failed'] ?>">

NA
<input class="form-control" type="number" name="na"
value="<?= $host['na_checks'] ?>">

Score
<input class="form-control" type="number" name="score"
value="<?= $host['score'] ?>">

<br>

<button class="btn btn-primary">Update</button>

</form>

</body>
</html>
