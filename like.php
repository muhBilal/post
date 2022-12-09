<?php

include "config.php";

if (!isset($_SESSION['uname'])) {
    header('Location: index.php');
}


$users = $_SESSION['uname'];
$query_user_id = mysqli_query($con, "SELECT id FROM users WHERE username='$users'");
$data_user_id = 0;
while($data = mysqli_fetch_assoc($query_user_id)){
    $data_user_id = $data;
}

$user_id = (int)$data_user_id['id'];
$post_id = (int)$_POST['id'];

$post_users = mysqli_query($con, "SELECT * FROM post_users WHERE post_id=$post_id AND user_id=$user_id");
if(mysqli_num_rows($post_users) > 0){
    $query = mysqli_query($con, "DELETE FROM post_users WHERE post_id=$post_id AND user_id=$user_id");
    $posts = mysqli_query($con, "SELECT * FROM posts WHERE id=$post_id");
    $likes = 0;
    while($data = mysqli_fetch_assoc($posts)){
        $likes = (int)$data['likes'] - 1;
    }
    $post = mysqli_query($con, "UPDATE posts SET likes=$likes WHERE id=$post_id");
    echo "unlike";
}else{
    $query = mysqli_query($con, "INSERT INTO post_users(user_id, post_id) VALUES($user_id, $post_id)");
    $posts = mysqli_query($con, "SELECT * FROM posts WHERE id=$post_id");
    $likes = 0;
    while($data = mysqli_fetch_assoc($posts)){
        $likes = (int)$data['likes'] + 1;
    }
    $post = mysqli_query($con, "UPDATE posts SET likes=$likes WHERE id=$post_id");
    echo "like";
}