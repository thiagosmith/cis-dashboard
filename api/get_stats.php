<?php

include("../config/db.php");

$sql = "SELECT agent,score,passed,failed FROM hosts";

$result = $conn->query($sql);

$data = [];

while($row = $result->fetch_assoc()){

$data[] = $row;

}

echo json_encode($data);

?>
