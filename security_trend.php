<?php
include 'db.php';

$result = $conn->query("
SELECT DATE(created_at) as data, AVG(score) as media_score
FROM hosts
GROUP BY DATE(created_at)
ORDER BY data
");

$labels = [];
$data = [];

while($row = $result->fetch_assoc()){
    $labels[] = $row['data'];
    $data[] = round($row['media_score'],2);
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Evolução de Segurança</title>

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

<h2>Evolução de Segurança do Ambiente</h2>

<a href="dashboard.php" class="btn btn-success mb-3">← Dashboard</a>

<div class="card p-4">

<canvas id="trendChart"></canvas>

</div>

</div>

<script>

new Chart(document.getElementById('trendChart'),{

type:'line',

data:{
labels: <?php echo json_encode($labels); ?>,
datasets:[{
label:'Score médio do ambiente',
data: <?php echo json_encode($data); ?>,
tension:0.3
}]
}

});

</script>

</body>
</html>
