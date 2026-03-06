<?php
session_start();
include 'db.php';

$result = $conn->query("SELECT * FROM audit_log ORDER BY date DESC");
?>

<!DOCTYPE html>
<html>
<head>

<title>Audit Log</title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

</head>

<body>

<div class="container mt-4">

<h2>Audit Log</h2>

<table class="table table-bordered">

<tr>
<th>User</th>
<th>Action</th>
<th>Date</th>
</tr>

<?php while($row=$result->fetch_assoc()){ ?>

<tr>
<td><?php echo $row['user']; ?></td>
<td><?php echo $row['action']; ?></td>
<td><?php echo $row['date']; ?></td>
</tr>

<?php } ?>

</table>

</div>

</body>
</html>
