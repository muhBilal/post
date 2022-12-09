<?php

include 'config.php';

if (!isset($_SESSION['uname'])) {
    header('Location: index.php');
}

$per_page = 3;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page > 1) ? ($page * $per_page) - $per_page : 0;
$query = mysqli_query($con, "SELECT * FROM posts LIMIT $start, $per_page");
$posts = mysqli_query($con, "SELECT * FROM posts");
$total_post = mysqli_num_rows($posts);
$data_posts = [];
$data_post_users = [];

while($post = mysqli_fetch_assoc($query)){
    array_push($data_posts, $post);
    $id = $post['id'];
    $user_posts = mysqli_query($con, "SELECT * FROM post_users WHERE post_id=$id");

    while($post_user = mysqli_fetch_assoc($user_posts)){
        array_push($data_post_users, $post_user);
    }
}


header("Content-type:application/json");

$data = [$data_posts, $data_post_users, $per_page, $total_post];

echo json_encode($data);