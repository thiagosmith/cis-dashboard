<?php
include "db.php";

$query="SELECT agent, score FROM hosts WHERE score <50 ORDER BY score ASC";

$result=$conn->query($query);
?>

<!DOCTYPE html>
<html>

<head>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

</head>

<body style="background:black;color:#00ff9f;font-family:monospace">

<div class="container mt-5">

<h1>Hosts Críticos</h1>

<a href="dashboard.php" class="btn btn-secondary mb-3">Voltar</a>

<table class="table table-dark">

<tr>
<th>Host</th>
<th>Score</th>
</tr>

<?php while($row=$result->fetch_assoc()){ ?>

<tr>
<td><?php echo $row['agent'] ?></td>
<td><?php echo $row['score'] ?></td>
</tr>

<?php } ?>

</table>

</div>

</body>
</html>
