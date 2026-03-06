<?php
include "db.php";

$query="SELECT agent, ip, passed, failed, na_checks, score, created_at 
FROM hosts 
ORDER BY created_at DESC";

$result=$conn->query($query);
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
color:#00ff9f;
}

.btn-hacker{
background:black;
border:1px solid #00ff9f;
color:#00ff9f;
}

.btn-hacker:hover{
background:#00ff9f;
color:black;
}

</style>

</head>

<body>

<div class="container mt-5">

<h1>Últimas Avaliações de Segurança</h1>

<a href="dashboard.php" class="btn btn-hacker mb-3">Dashboard</a>

<table class="table table-dark table-striped">

<tr>
<th>Host</th>
<th>IP</th>
<th>Passed</th>
<th>Failed</th>
<th>NA</th>
<th>Score</th>
<th>Data da Avaliação</th>
</tr>

<?php while($row=$result->fetch_assoc()){ ?>

<tr>

<td><?php echo $row['agent']; ?></td>

<td><?php echo $row['ip']; ?></td>

<td><?php echo $row['passed']; ?></td>

<td><?php echo $row['failed']; ?></td>

<td><?php echo $row['na_checks']; ?></td>

<td><?php echo $row['score']; ?></td>

<td><?php echo $row['created_at']; ?></td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>
