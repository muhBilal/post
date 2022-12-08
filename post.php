<?php

include 'config.php';

if (!isset($_SESSION['uname'])) {
    header('Location: index.php');
}

$per_page = 3;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page > 1) ? ($page * $per_page) - $per_page : 0;
$query = mysqli_query($con, "SELECT * FROM posts LIMIT $start, $per_page");
$posts = [];

while($post = mysqli_fetch_assoc($query)){
    array_push($posts, $post);
}

header("Content-type:application/json");

echo json_encode($posts);