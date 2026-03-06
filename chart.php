<?php
session_start();
include 'db.php';

// Verifica login
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
$role = $_SESSION['role'];

// Consulta os valores para o gráfico
$result = $conn->query("SELECT SUM(passed) as total_passed, SUM(failed) as total_failed, SUM(score) as total_score FROM hosts");
$data = $result->fetch_assoc();

$labels = ['Passed', 'Failed', 'Score'];
$values = [(int)$data['total_passed'], (int)$data['total_failed'], (int)$data['total_score']];
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CIS Compliance Benchmark</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js"></script>
<style>
body{
    background:#0a0a0a;
    color:#00ff9f;
    font-family:monospace;
}

.navbar, .topbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:10px 30px;
    border-bottom:1px solid #00ff9f;
    background:#000;
}

.user-box{
    margin-right:20px;
}

.card{
    background:#111;
    border:1px solid #00ff9f;
}

.btn-hacker{
    background:#000;
    border:1px solid #00ff9f;
    color:#00ff9f;
    font-weight:bold;
}

.btn-hacker:hover{
    background:#00ff9f;
    color:#000;
}

.container{
    margin-top:30px;
}

.chart-container{
    width: 60%;
    margin:auto;
}
</style>
</head>
<body>

<!-- TOPBAR -->
<div class="topbar">
    <div>
        <a href="dashboard.php" class="btn btn-hacker">Dashboard</a>
        <?php if($role == 'admin'){ ?>
            <a href="admin/users.php" class="btn btn-hacker">Admin</a>
        <?php } ?>
    </div>
    <div class="user-box">
        User: <strong><?php echo htmlspecialchars($username); ?></strong>
        <a href="logout.php" class="btn btn-hacker ms-2">Logout</a>
    </div>
</div>

<div class="container text-center">
    <h2>CIS Compliance Benchmark</h2>
    <div class="chart-container">
        <canvas id="pieChart"></canvas>
    </div>
    <a href="dashboard.php" class="btn btn-hacker mt-3">← Dashboard</a>
</div>

<script>
const data = {
    labels: <?php echo json_encode($labels); ?>,
    datasets: [{
        data: <?php echo json_encode($values); ?>,
        backgroundColor: [
            'rgba(0, 255, 0, 0.7)',
            'rgba(255, 0, 0, 0.7)',
            'rgba(54, 162, 235, 0.7)'
        ],
        borderColor: '#0a0a0a',
        borderWidth: 2
    }]
};

const config = {
    type: 'pie',
    data: data,
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom',
                labels: { color:'#00ff9f', font: { size:16 } }
            },
            datalabels: {
                color: '#fff',
                formatter: (value, ctx) => {
                    let sum = ctx.chart.data.datasets[0].data.reduce((a,b)=>a+b,0);
                    let percentage = (value*100 / sum).toFixed(1)+"%";
                    return percentage;
                },
                font: { weight: 'bold', size: 14 }
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        let total = context.dataset.data.reduce((a,b)=>a+b,0);
                        let value = context.raw;
                        let percentage = ((value / total) * 100).toFixed(1) + '%';
                        return context.label + ': ' + value + ' (' + percentage + ')';
                    }
                }
            }
        }
    },
    plugins: [ChartDataLabels]
};

new Chart(
    document.getElementById('pieChart'),
    config
);
</script>

</body>
</html>
