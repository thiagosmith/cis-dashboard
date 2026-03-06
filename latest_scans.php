<?php
session_start();

if(!isset($_SESSION['user'])){
header("Location: login.php");
exit();
}

include "db.php";

$result = $conn->query("
SELECT agent, ip, score, passed, failed, na_checks, created_at
FROM hosts
ORDER BY created_at DESC
");
?>

<!DOCTYPE html>
<html>

<head>

<title>Últimas Avaliações</title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<style>

body{
background:black;
color:#00ff9f;
font-family:monospace;
}

table{
background:#111;
}

</style>

</head>

<body>

<div class="container mt-4">

<h2>Últimas Avaliações</h2>

<a href="dashboard.php" class="btn btn-secondary mb-4">Voltar</a>

<table class="table table-dark table-striped">

<thead>

<tr>
<th>Host</th>
<th>IP</th>
<th>Score</th>
<th>Passed</th>
<th>Failed</th>
<th>NA</th>
<th>Data</th>
</tr>

</thead>

<tbody>

<?php while($row = $result->fetch_assoc()){ ?>

<tr>

<td><?php echo $row['agent']; ?></td>
<td><?php echo $row['ip']; ?></td>
<td><?php echo $row['score']; ?></td>
<td><?php echo $row['passed']; ?></td>
<td><?php echo $row['failed']; ?></td>
<td><?php echo $row['na_checks']; ?></td>
<td><?php echo $row['created_at']; ?></td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</body>

</html>
