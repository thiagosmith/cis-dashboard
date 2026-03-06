<?php
include "../auth.php";
include "../db.php";

if($_SESSION['role']!='admin'){
die("Acesso negado");
}

$username=$_POST['username'];
$password=password_hash($_POST['password'],PASSWORD_DEFAULT);
$role=$_POST['role'];

$stmt=$conn->prepare("
INSERT INTO users (username,password,role)
VALUES (?,?,?)
");

$stmt->bind_param("sss",$username,$password,$role);

$stmt->execute();

header("Location: users.php");
