<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
$role = $_SESSION['role'];

$result = $conn->query("SELECT agent, score FROM hosts ORDER BY score ASC LIMIT 10");

$labels = [];
$scores = [];

while($row = $result->fetch_assoc()){
    $labels[] = $row['agent'];
    $scores[] = $row['score'];
}

$totalHosts = $conn->query("SELECT COUNT(*) as total FROM hosts")->fetch_assoc()['total'];
$avgScore = $conn->query("SELECT ROUND(AVG(score),1) as avg FROM hosts")->fetch_assoc()['avg'];
$criticalHosts = $conn->query("SELECT COUNT(*) as total FROM hosts WHERE score < 40")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html>
<head>
<title>CIS Controls Security Dashboard</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<style>
body {
    background:#0a0a0a;
    color:#00ff9f;
    font-family:monospace;
}

.navbar {
    background:#000;
    border-bottom:1px solid #00ff9f;
}

.card {
    background:#111;
    border:1px solid #00ff9f;
}

.btn-hacker {
    background:#000;
    border:1px solid #00ff9f;
    color:#00ff9f;
}

.btn-hacker:hover {
    background:#00ff9f;
    color:#000;
}

.topbar {
    display:flex;
    justify-content:flex-end;
    align-items:center;
    padding:10px 30px;
    border-bottom:1px solid #00ff9f;
    background:#000;
}

.user-box {
    margin-right:20px;
}

/* 🔧 Ajuste: fontes dos cards iguais ao "Score por Host" */
.card h5 {
    font-family: monospace;
    font-weight: normal;
    font-size: 1.2rem;
    color: #00ff9f;
    margin: 0;
}

.card h2 {
    font-family: monospace;
    font-weight: bold;     /* deixa o número mais destacado */
    font-size: 4rem;     /* aumenta o tamanho da fonte */
    color: #00ff9f;
    margin: 0;
}
.footer {
    border-top: 1px solid #00ff9f;
    color: #00ff9f;
    font-family: monospace;
    background: #000;
}

</style>
</head>

<body>
<!-- TOP BAR -->
<div class="topbar">
    <div class="user-box">
        User: <strong><?php echo $username; ?></strong>
    </div>
    <?php if($role == 'admin'){ ?>
        <a href="admin/users.php" class="btn btn-hacker me-2">Admin</a>
    <?php } ?>
    <a href="logout.php" class="btn btn-danger">Logout</a>
</div>

<div class="container mt-4">
    <h2>CIS Controls Security Dashboard</h2>
    <br>

    <div class="row">
        <div class="col-md-4">
            <div class="card p-3 text-center">
                <h5>Total de Hosts</h5>
                <h2><?php echo $totalHosts ?></h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 text-center">
                <h5>Conformidade de Segurança</h5>
                <h2><?php echo $avgScore ?>%</h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 text-center">
                <h5>Hosts Críticos</h5>
                <h2><?php echo $criticalHosts ?></h2>
            </div>
        </div>
    </div>

    <br>
    <h4>Score por Host</h4>
    <div class="card p-4">
        <canvas id="scoreChart"></canvas>
    </div>

    <br>
    <div class="row">
        <div class="col-md-12">
            <a href="hosts.php" class="btn btn-hacker w-100">Gerenciamento de Hosts</a>
            <br><br>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <a href="critical_hosts.php" class="btn btn-hacker w-100">Hosts com Score Crítico</a>
        </div>
        <div class="col-md-4">
            <a href="top_risk.php" class="btn btn-hacker w-100">Top Security Ranking</a>
        </div>
        <div class="col-md-4">
            <a href="risk_distribution.php" class="btn btn-hacker w-100">Distribuição de Risco</a>
        </div>
    </div>

    <br>
    <div class="row">
        <div class="col-md-4">
            <a href="security_trend.php" class="btn btn-hacker w-100">Evolução de Segurança</a>
        </div>
        <div class="col-md-4">
            <a href="last_evaluations.php" class="btn btn-hacker w-100">Últimas Avaliações</a>
        </div>
        <div class="col-md-4">
            <a href="chart.php" class="btn btn-hacker w-100">Métricas</a>
        </div>
    </div>

    <br>
    <div class="row">
        <div class="col-md-12">
            <a href="admin/users.php" class="btn btn-hacker w-100">Administração de Usuários</a>
        </div>
    </div>
</div>

<script>
const ctx = document.getElementById('scoreChart');
new Chart(ctx, {
    type:'bar',
    data:{
        labels: <?php echo json_encode($labels) ?>,
        datasets:[{
            label:'Security Score',
            data: <?php echo json_encode($scores) ?>,
            borderWidth:1
        }]
    },
    options:{
        plugins:{ legend:{display:false} },
        scales:{ y:{ beginAtZero:true, max:100 } }
    }
});
</script>
</body>
<footer class="footer mt-5 p-3 text-center">
    <small>Copyright @ 2025 Smith Braz | https://github.com/thiagosmith/cis-dashboard | 5M1TH</small>
</footer>
</html>
