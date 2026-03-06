<?php
include "../auth.php";
include "../db.php";

if($_SESSION['role']!='admin'){
die("Acesso negado");
}

$result=$conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html>

<head>

<title>Gerenciar Usuários</title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<style>

body{
background:black;
color:#00ff9f;
font-family:monospace;
}

table{
color:#00ff9f;
}

</style>

</head>

<body>

<div class="container mt-5">

<h1>Administração de Usuários</h1>

<a href="../dashboard.php" class="btn btn-secondary mb-3">Dashboard</a>
<a href="add_user.php" class="btn btn-success mb-3">Novo Usuário</a>

<table class="table table-dark">

<tr>
<th>ID</th>
<th>Usuário</th>
<th>Role</th>
<th>Ações</th>
</tr>

<?php while($row=$result->fetch_assoc()){ ?>

<tr>

<td><?php echo $row['id'] ?></td>
<td><?php echo $row['username'] ?></td>
<td><?php echo $row['role'] ?></td>

<td>

<a href="edit_user.php?id=<?php echo $row['id'] ?>" class="btn btn-warning btn-sm">
Editar
</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>
