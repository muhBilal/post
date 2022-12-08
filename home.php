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
    <title>Postify | Home</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
</head>

<body>
    <div class="header">
        <h1>Homepage</h1>
        <a href="logout.php" class="btn-danger">Logout</a>
    </div>

    <div class="container">
        <?php while ($post = mysqli_fetch_assoc($query)) : ?>
            <div class="card">
                <img src="<?= $post['image']; ?>" alt="post-image">
                <div class="action">
                    <div class="like">
                        <i onclick="likePost(<?= $post['id']; ?>)" class="fa-solid fa-heart heart"></i>
                        <p>Total like: <?= $post['likes']; ?></p>
                    </div>
                    <i class="fa-solid fa-comment comment"></i>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <script>
        function likePost(id) {
            $.ajax({
                url: 'like.php',
                type: 'post',
                data: {
                    id: id
                },
                success: function(response) {
                    var msg = "";
                    location.reload()
                }
            });
        }
    </script>
</body>

</html>