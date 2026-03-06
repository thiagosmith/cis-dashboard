<?php
// Exemplo de valores (depois você pode puxar do banco)
$passed = 15;
$failed = 5;
$score  = 10;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Resultados</title>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
body{
    font-family: Arial;
    background:#0f172a;
    color:white;
    text-align:center;
}

.container{
    width:600px;
    margin:auto;
    margin-top:80px;
}

canvas{
    background:white;
    border-radius:10px;
    padding:20px;
}
</style>

</head>
<body>

<div class="container">

<h2>Resultado das Avaliações</h2>

<canvas id="resultChart"></canvas>

</div>

<script>

const data = {
    labels: ['Passed', 'Failed', 'Score'],
    datasets: [{
        data: [
            <?php echo $passed; ?>,
            <?php echo $failed; ?>,
            <?php echo $score; ?>
        ],
        backgroundColor: [
            '#22c55e',
            '#ef4444',
            '#3b82f6'
        ]
    }]
};

const config = {
    type: 'pie',
    data: data,
    options:{
        plugins:{
            legend:{
                position:'bottom'
            }
        }
    }
};

new Chart(
    document.getElementById('resultChart'),
    config
);

</script>

</body>
</html>
