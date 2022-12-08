<?php
include "config.php";

if (!isset($_SESSION['uname'])) {
    header('Location: index.php');
}

$per_page = 12;

$posts = mysqli_query($con, "SELECT * FROM posts");
$total_post = mysqli_num_rows($posts);

$links = ceil($total_post / $per_page);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postify | Home</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
</head>

<body>
    <div class="header">
        <h1>Homepage</h1>
        <a href="logout.php" class="btn-danger">Logout</a>
    </div>

    <div class="container">

    </div>

    <div class="links">
        <?php for ($i = 1; $i <= $links; ++$i) : ?>
            <div>
                <a href="?page=<?= $i; ?>" class="link" data-page="<?= $i; ?>"><?= $i; ?></a>
            </div>
        <?php endfor; ?>
    </div>


    <script>
        $('document').ready(() => {
            getPosts()
        })
        const links = document.querySelectorAll('.link')
        let posts = ''
        links.forEach(link => {
            const page = link.getAttribute('data-page')
            link.addEventListener('click', (e) => {
                e.preventDefault()
                getPosts(page)
            })
        })

        function getPosts(page = 1) {
            $.get('post.php?page=' + page, (data) => {
                posts = data
                $('.container').html('')
                posts.forEach(post => {
                    const data = `<div class="card">
                        <img src="${post.image}" alt="post-image">
                        <div class="action">
                            <div class="like">
                                <i onclick="likePost(${post.id})" class="fa-solid fa-heart heart"></i>
                                <p>Total like: ${post.likes}</p>
                            </div>
                            <i class="fa-solid fa-comment comment"></i>
                        </div>
                    </div>`

                    $('.container').append(data)
                    history.pushState('', '', '?page=' + page)
                })
            })
        }

        function likePost(id) {
            $.ajax({
                url: 'like.php',
                type: 'post',
                data: {
                    id: id
                },
                success: function(response) {
                    var msg = "";
                    const url = window.location.search
                    const page = url[url.length - 1]
                    getPosts(page)
                }
            });
        }
    </script>
</body>

</html>