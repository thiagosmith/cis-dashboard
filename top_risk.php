<?php
include 'db.php';

$result = $conn->query("
SELECT agent, score
FROM hosts
ORDER BY score ASC
LIMIT 10
");

$labels = [];
$data = [];

while ($row = $result->fetch_assoc()) {
    $labels[] = $row['agent'];
    $data[] = $row['score'];
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Top Security Risk</title>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

</style>

</head>

<body>

<div class="container mt-5">

<h2>Top Security Risk</h2>

<a href="dashboard.php" class="btn btn-success mb-3">← Dashboard</a>

<div class="card p-4">

<canvas id="riskChart"></canvas>

</div>

</div>

<script>

new Chart(document.getElementById('riskChart'),{

type:'bar',

data:{
labels: <?php echo json_encode($labels); ?>,
datasets:[{
label:'Security Score',
data: <?php echo json_encode($data); ?>
}]
}

});

</script>

</body>
</html>
