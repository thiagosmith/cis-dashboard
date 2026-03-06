<?php
include "../auth.php";
include "../db.php";

if($_SESSION['role']!='admin'){
die("Acesso negado");
}

$id=$_POST['id'];
$username=$_POST['username'];
$role=$_POST['role'];
$password=$_POST['password'];

if($password!=""){

$hash=password_hash($password,PASSWORD_DEFAULT);

$stmt=$conn->prepare("
UPDATE users
SET username=?,password=?,role=?
WHERE id=?
");

$stmt->bind_param("sssi",$username,$hash,$role,$id);

}else{

$stmt=$conn->prepare("
UPDATE users
SET username=?,role=?
WHERE id=?
");

$stmt->bind_param("ssi",$username,$role,$id);

}

$stmt->execute();

header("Location: users.php");
