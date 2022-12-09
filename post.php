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


$user_username = $_SESSION['uname'];
$user_query = mysqli_query($con, "SELECT * FROM users WHERE username='$user_username'");
$user_id = 0;
while($data = mysqli_fetch_assoc($user_query)){
    $user_id = (int)$data['id'];
}

$data_posts = [];
$data_post_users = [];

$user_posts = mysqli_query($con, "SELECT * FROM post_users WHERE user_id=$user_id");
while($post = mysqli_fetch_assoc($query)){
    array_push($data_posts, $post);
    while($post_user = mysqli_fetch_assoc($user_posts)){
        // array_push($data_posts, $post_user);
        // $data_posts[]
    }
}




header("Content-type:application/json");

$data = [$data_posts, $per_page, $total_post];

echo json_encode($data);