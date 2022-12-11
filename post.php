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
$user_query = mysqli_query($con, "SELECT * FROM users as u LEFT JOIN post_users as pu ON pu.user_id = u.id WHERE u.username='$user_username'");
$user_posts = [];
while($data = mysqli_fetch_assoc($user_query)){
    array_push($user_posts, $data);
}

$data_posts = [];

while($post = mysqli_fetch_assoc($query)){
    array_push($data_posts, $post);
}

foreach($data_posts as $index => $post){
    foreach($user_posts as $user){
        if($post['id'] == $user['post_id']){
            $post['is_like'] = true;
            $data_posts[$index] = $post;
        } 
    }
}

header("Content-type:application/json");

$data = [$data_posts, $per_page, $total_post];

echo json_encode($data);