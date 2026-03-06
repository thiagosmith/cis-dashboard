<?php
session_start();

if(!isset($_SESSION['user'])){
header("Location: login.php");
exit();
}

include "db.php";

$result = $conn->query("
SELECT DATE(created_at) as data,
AVG(score) as media
FROM hosts
GROUP BY DATE(created_at)
ORDER BY data
");

$datas=[];
$scores=[];

while($row = $result->fetch_assoc()){
$datas[] = $row['data'];
$scores[] = $row['media'];
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Evolução de Segurança</title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

body{
background:black;
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

<div class="container mt-4">

<h2>Evolução de Segurança</h2>

<a href="dashboard.php" class="btn btn-secondary mb-4">Voltar</a>

<canvas id="evolutionChart"></canvas>

</div>

<script>

new Chart(document.getElementById("evolutionChart"),{

type:'line',

data:{
labels: <?php echo json_encode($datas); ?>,
datasets:[{
label:'Score médio',
data: <?php echo json_encode($scores); ?>,
borderColor:'#00ff9f',
fill:false
}]
}

});

</script>

</body>

</html>
