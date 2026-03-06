<?php
include 'auth_check.php';
include 'db.php';

$result = $conn->query("SELECT agent,score FROM hosts ORDER BY score ASC");
?>

<!DOCTYPE html>
<html>

<head>

<title>Risk Heatmap</title>

<link rel="stylesheet"
href="assets/style.css">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

</head>

<body class="bg-dark text-light">

<div class="container mt-5">

<h2 class="text-danger">Risk Heatmap</h2>

<a href="dashboard.php" class="btn btn-success mb-4">Dashboard</a>

<table class="table table-dark table-striped">

<tr>
<th>Host</th>
<th>Score</th>
<th>Risk</th>
</tr>

<?php

while($row = $result->fetch_assoc()){

$score = $row['score'];

if($score < 20){
$color = "danger";
$risk = "CRITICAL";
}
elseif($score < 40){
$color = "warning";
$risk = "HIGH";
}
elseif($score < 60){
$color = "info";
$risk = "MEDIUM";
}
else{
$color = "success";
$risk = "GOOD";
}

echo "<tr class='table-$color'>
<td>{$row['agent']}</td>
<td>{$score}</td>
<td>$risk</td>
</tr>";

}
?>

</table>

</div>

</body>
</html>
