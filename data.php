<?php
include 'config.php';
header('Content-Type: application/json');

$sql = "SELECT * FROM posts";
$result = mysqli_query($con, $sql);
$data = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($data, $row);
    }
}

echo $data;