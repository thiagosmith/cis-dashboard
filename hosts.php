<?php
include "db.php";

$query="SELECT * FROM hosts ORDER BY agent ASC";
$result=$conn->query($query);
?>

<!DOCTYPE html>
<html>

<head>

<title>Hosts</title>

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

<h1>Gerenciamento de Hosts</h1>

<a href="dashboard.php" class="btn btn-hacker mb-3">Dashboard</a>
<a href="add_host.php" class="btn btn-success mb-3">Novo Host</a>

<table class="table table-dark table-striped">

<tr>
<th>ID</th>
<th>Agent</th>
<th>IP</th>
<th>Passed</th>
<th>Failed</th>
<th>NA</th>
<th>Score</th>
<th>Ações</th>
</tr>

<?php while($row=$result->fetch_assoc()){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['agent']; ?></td>

<td><?php echo $row['ip']; ?></td>

<td><?php echo $row['passed']; ?></td>

<td><?php echo $row['failed']; ?></td>

<td><?php echo $row['na_checks']; ?></td>

<td><?php echo $row['score']; ?></td>

<td>

<a href="edit_host.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Editar</a>

<a href="delete_host.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Excluir</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>
