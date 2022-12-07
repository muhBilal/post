<?php
include "config.php";

if (!isset($_SESSION['uname'])) {
    header('Location: index.php');
}

$query = mysqli_query($con, "SELECT * FROM posts");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>

</head>

<body>
    <h1>Homepage</h1>
    <br>
    <div id="content">
        <?php while($post = mysqli_fetch_assoc($query)): ?>
            <div class="card">
                <div class="card-content">
                    <div class="image">
                        <img src="./JSS.png" alt="post-image">
                    </div>
                    <div class="text-content">
                        <div class="heading">
                            <h2><?= $post['title']; ?></h2>
                        </div>
                        <div class="description">
                            <p><?= $post['description']; ?></p>
                        </div>
                    </div>
                    <div class="like-btn">
                        <p>Total like: <?= $post['likes']; ?></p>
                        <!-- <a href="like.php?like=">Like</a> -->
                        <button onclick="likePost(<?= $post['id']; ?>)">Like</button>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    <a href="logout.php">Logout</a>

    <script>
        function likePost(id){
            $.ajax({
                url:'like.php',
                type:'post',
                data:{id: id},
                success:function(response){
                    var msg = "";
                    alert('Success like')
                    location.reload()
                }
            });
        }        
    </script>
</body>

</html>