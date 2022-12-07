<?php
include "config.php";

if (!isset($_SESSION['uname'])) {
    header('Location: index.php');
}

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
    <div id="content"></div>
    <a href="logout.php">Logout</a>

    <script>
        $(document).ready(function(){
            loadData
        })

        function loadData(){
            $.get('data.php', function(data){
                $('#content').html(data)
            })
        }
    </script>
</body>

</html>