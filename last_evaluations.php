<?php
include 'db.php';

$result = $conn->query("
SELECT id, agent, ip, passed, failed, na_checks, score, created_at
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
background:#0a0a0a;
color:#00ff9f;
font-family:monospace;
}

.card{
background:#111;
border:1px solid #00ff9f;
}

.table{
color:white;
}

</style>

</head>

<body>

<div class="container mt-5">

<h2>Últimas Avaliações de Segurança</h2>

<a href="dashboard.php" class="btn btn-success mb-3">← Voltar ao Dashboard</a>

<div class="card p-4">

<table class="table table-dark table-striped">

<thead>

<tr>
<th>ID</th>
<th>Host</th>
<th>IP</th>
<th>Passed</th>
<th>Failed</th>
<th>N/A</th>
<th>Score</th>
<th>Avaliação</th>
</tr>

</thead>

<tbody>

<?php while($row = $result->fetch_assoc()): ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['agent']; ?></td>

<td><?php echo $row['ip']; ?></td>

<td><?php echo $row['passed']; ?></td>

<td><?php echo $row['failed']; ?></td>

<td><?php echo $row['na_checks']; ?></td>

<td>

<?php
$score = $row['score'];

if($score >= 80){
echo "<span class='badge bg-success'>$score</span>";
}
elseif($score >= 50){
echo "<span class='badge bg-warning'>$score</span>";
}
else{
echo "<span class='badge bg-danger'>$score</span>";
}
?>

</td>

<td><?php echo $row['created_at']; ?></td>

</tr>

<?php endwhile; ?>

</tbody>

</table>

</div>

</div>

</body>
</html>
