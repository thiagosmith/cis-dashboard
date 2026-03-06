<?php
session_start();
include 'db.php';

$error = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE username=?");
$stmt->bind_param("s",$username);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows == 1){

$user = $result->fetch_assoc();

if(password_verify($password, $user['password'])){

$_SESSION['user_id'] = $user['id'];
$_SESSION['username'] = $user['username'];
$_SESSION['role'] = $user['role'];

header("Location: dashboard.php");
exit;

}else{

$error = "Senha inválida";

}

}else{

$error = "Usuário não encontrado";

}

}
?>

<!DOCTYPE html>
<html>

<head>

<title>CIS Controls Security Dashboard - Login</title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<style>

body{
background:#000;
color:#00ff9f;
font-family:monospace;
display:flex;
justify-content:center;
align-items:center;
height:100vh;
}

.card{
background:#111;
border:1px solid #00ff9f;
padding:30px;
width:400px;
}

.btn-hacker{
background:#000;
border:1px solid #00ff9f;
color:#00ff9f;
}

.btn-hacker:hover{
background:#00ff9f;
color:#000;
}

</style>

</head>

<body>

<div class="card">

<h3 class="text-center mb-4">CIS Controls AC Security Dashboard</h3>

<form method="POST">

<div class="mb-3">
<label>Username</label>
<input type="text" name="username" class="form-control">
</div>

<div class="mb-3">
<label>Password</label>
<input type="password" name="password" class="form-control">
</div>

<?php if($error != ""){ ?>

<div class="alert alert-danger">
<?php echo $error ?>
</div>

<?php } ?>

<button class="btn btn-hacker w-100">Login</button>

</form>

</div>

</body>
</html>
