<?php
include "../auth.php";

if($_SESSION['role']!='admin'){
die("Acesso negado");
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Novo Usuário</title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<style>

body{
background:black;
color:#00ff9f;
font-family:monospace;
}

input,select{
background:black !important;
color:#00ff9f !important;
border:1px solid #00ff9f !important;
}

</style>

</head>

<body>

<div class="container mt-5">

<h2>Novo Usuário</h2>

<form action="save_user.php" method="post">

<div class="mb-3">
<label>Usuário</label>
<input type="text" name="username" class="form-control">
</div>

<div class="mb-3">
<label>Senha</label>
<input type="password" name="password" class="form-control">
</div>

<div class="mb-3">
<label>Tipo</label>

<select name="role" class="form-control">

<option value="user">User</option>
<option value="admin">Admin</option>

</select>

</div>

<button class="btn btn-success">
Criar
</button>

</form>

</div>

</body>
</html>
