<?php
include "../auth.php";
include "../db.php";

if($_SESSION['role']!='admin'){
die("Acesso negado");
}

$id = $_GET['id'];

$stmt=$conn->prepare("SELECT * FROM users WHERE id=?");
$stmt->bind_param("i",$id);
$stmt->execute();
$result=$stmt->get_result();

$user=$result->fetch_assoc();
?>

<!DOCTYPE html>
<html>

<head>

<title>Editar Usuário</title>

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

<h2>Editar Usuário</h2>

<form action="update_user.php" method="post">

<input type="hidden" name="id" value="<?php echo $user['id']; ?>">

<div class="mb-3">
<label>Usuário</label>
<input type="text" name="username"
value="<?php echo $user['username']; ?>"
class="form-control">
</div>

<div class="mb-3">
<label>Nova senha (opcional)</label>
<input type="password" name="password"
class="form-control">
</div>

<div class="mb-3">
<label>Tipo de acesso</label>

<select name="role" class="form-control">

<option value="admin"
<?php if($user['role']=="admin") echo "selected"; ?>>
Admin
</option>

<option value="user"
<?php if($user['role']=="user") echo "selected"; ?>>
User
</option>

</select>

</div>

<button class="btn btn-success">
Atualizar
</button>

<a href="users.php" class="btn btn-secondary">
Voltar
</a>

</form>

</div>

</body>
</html>
