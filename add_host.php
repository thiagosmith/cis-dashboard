<?php
include 'db.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

$agent = $_POST['agent'];
$ip = $_POST['ip'];
$passed = $_POST['passed'];
$failed = $_POST['failed'];
$na_checks = $_POST['na_checks'];
$score = $_POST['score'];

$stmt = $conn->prepare("INSERT INTO hosts (agent, ip, passed, failed, na_checks, score) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssiiii", $agent, $ip, $passed, $failed, $na_checks, $score);

if($stmt->execute()){
header("Location: hosts.php");
exit;
}else{
$error = "Erro ao salvar host.";
}

}
?>

<!DOCTYPE html>
<html>

<head>

<title>Add Host</title>

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

input{
background:#000 !important;
color:#00ff9f !important;
border:1px solid #00ff9f !important;
}

</style>

</head>

<body>

<div class="container mt-5">

<h2>Add Host Evaluation</h2>

<a href="hosts.php" class="btn btn-success mb-3">← Voltar</a>

<div class="card p-4">

<?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

<form method="POST">

<div class="mb-3">
<label>Host Name</label>
<input type="text" name="agent" class="form-control" required>
</div>

<div class="mb-3">
<label>IP Address</label>
<input type="text" name="ip" class="form-control" required>
</div>

<div class="mb-3">
<label>Passed Checks</label>
<input type="number" name="passed" class="form-control" required>
</div>

<div class="mb-3">
<label>Failed Checks</label>
<input type="number" name="failed" class="form-control" required>
</div>

<div class="mb-3">
<label>N/A Checks</label>
<input type="number" name="na_checks" class="form-control" required>
</div>

<div class="mb-3">
<label>Security Score</label>
<input type="number" name="score" class="form-control" required>
</div>

<button type="submit" class="btn btn-success">Salvar Avaliação</button>

</form>

</div>

</div>

</body>
</html>
