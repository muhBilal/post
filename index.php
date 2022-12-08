<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postify</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <div class="login">
        <div>
            <h1>Login</h1>
            <div id="message"></div>
            <form>
                <div class="row">
                    <label for="email">Email</label>
                    <input type="text" class="textbox" id="txt_uname" name="txt_uname" placeholder="Username" />

                </div>
                <div class="row">
                    <label for="password">Password</label>
                    <input type="password" class="textbox" id="txt_pwd" name="txt_pwd" placeholder="Password" />
                </div>
                <input type="button" value="Submit" name="but_submit" id="but_submit" class="button" />
            </form>
        </div>
    </div>


    <script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $("#but_submit").click(function() {
                var username = $("#txt_uname").val().trim();
                var password = $("#txt_pwd").val().trim();

                if (username != "" && password != "") {
                    $.ajax({
                        url: 'checkUser.php',
                        type: 'post',
                        data: {
                            username: username,
                            password: password
                        },
                        success: function(response) {
                            var msg = "";
                            if (response == 1) {
                                window.location = "home.php";
                            } else {
                                msg = "Invalid username and password!";
                            }
                            $("#message").html(msg);
                        }
                    });
                }
            });

        });
    </script>
</body>

</html>