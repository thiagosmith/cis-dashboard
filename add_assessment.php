<?php
include "db.php";

$hosts=$conn->query("SELECT * FROM hosts");

if($_POST){

$host=$_POST['host'];
$score=$_POST['score'];

$conn->query("INSERT INTO assessments(host_id,score,date) VALUES($host,$score,NOW())");

header("Location: dashboard.php");

}

?>

<!DOCTYPE html>
<html>

<head>

<title>Novo Assessment</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

</head>

<body>

<div class="container mt-5">

<h2>Novo Assessment</h2>

<form method="post">

<select name="host" class="form-control">

<?php while($h=$hosts->fetch_assoc()){ ?>

<option value="<?php echo $h['id'] ?>"><?php echo $h['hostname'] ?></option>

<?php } ?>

</select>

<br>

<input type="number" name="score" class="form-control" min="0" max="100">

<br>

<button class="btn btn-success">Salvar</button>

</form>

</div>

</body>
</html>
