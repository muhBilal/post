<?php

include "config.php";

if (!isset($_SESSION['uname'])) {
    header('Location: index.php');
}

$id = $_POST['id'];

$query = mysqli_query($con, "select likes from posts where id=$id");

$post = mysqli_fetch_array($query);

$total_like = $post[0] + 1;

$update_query = mysqli_query($con, "update posts set likes=$total_like where id=$id");

echo 1;