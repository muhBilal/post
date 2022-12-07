<?php
include 'config.php';

$sql = "SELECT * FROM posts";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // echo $row['title'].", judul : ".$row['photo']."<br/>";
        echo "test";
    }
}
