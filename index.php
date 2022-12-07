<!doctype html>
<html>

<head>
    <title>Login page with jQuery and AJAX</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">

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
</head>

<body>
    <h1>Login</h1>
    <form>
        <div class="row">
            <label for="email">Email</label>
            <input type="text" class="textbox" id="txt_uname" name="txt_uname" placeholder="Username" />

        </div>
        <div class="row">
            <label for="password">Password</label>
            <input type="password" class="textbox" id="txt_pwd" name="txt_pwd" placeholder="Password" />
        </div>
        <input type="button" value="Submit" name="but_submit" id="but_submit" class="button"/>
    </form>
</body>

</html>