<!DOCTYPE html>
<html>
    <head>
        <title>Login Page</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    </head>
    <body style="background-color: lightgray">
        <div class="container">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6 center">
                    <div class="card" style=" margin-top: 80px;">
                        <h2 class="text-center py-4">LOGIN</h2>
                        <div class="card-body px-lg-5 pt-0">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                            
                                <label for="uname">USERNAME:</label><br>
                                <input type="text" class="form-control mb-2 mr-sm-2" name="username" value="<?php if (empty($_POST["username"])) {echo "";} else { echo $_POST["username"]; }?>" placeholder="Enter your username" required><br>
                                <label for="pwd">PASSWORD:</label><br>
                                <input type="password" class="form-control mb-2 mr-sm-2" name="password" value="<?php if (empty($_POST["username"])) {echo "";} else { echo $_POST["password"]; } ?>" placeholder="Enter your password" required><br>
                                <div class="row">
                                    <div class="col-sm-5"></div>
                                    <div class="col-sm-7 text-right">
                                        <div>
                                            <p>Not a member? <a href="register.php">Register</a></p>
                                        </div>
                                    </div>
                                </div>

                                <input type="submit" class="btn btn-info my-4 btn-block btn-lg" value="Login">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3"></div>
            </div>
        </div>

        <?php

        session_start();

        $out = "";

        if ( ! empty( $_POST ) ) {
            if ( isset( $_POST['username'] ) && isset( $_POST['password'] )) {
                $servername = "localhost";
                $db_username = "username";
                $db_password = "password";
                $dbname = "myDB";

                $conn = new mysqli ($servername, $db_username, $db_password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $stmt = $conn->prepare("SELECT username, user_password FROM users WHERE username = ?  AND  user_password = ? LIMIT 1");
                //$stmt->bind_param('s', $_POST['username']);
                $stmt->bind_param('ss', $_POST['username'], $_POST['password']);
                $stmt->execute();
                //$result = $stmt->get_result();
                $result = $stmt->store_result();
                //$user = $result->fetch_object();
                    
                // Verify user password and set $_SESSION
                /*if ( password_verify( $_POST['password'], $user->user_password ) ) {
                    $_SESSION['id'] = $user->ID;
                    echo "<script type='text/javascript'> location.href='main.php' </script>";
                } else {
                    echo "<script type='text/javascript'>alert('User Name Or Password Invalid!')</script>";
                }*/
                if($stmt->num_rows == 1) { //To check if the row exists
                    while($stmt->fetch()) { //fetching the contents of the row\
                        $out = "Success";
                        $_SESSION['Logged'] = 1;
                        $_SESSION['username'] = $_POST['username'];
                        echo "<script type='text/javascript'> alert('Login Successfully!'); window.location.href='main.php' </script>";
                        exit();
                    }
                } else {
                    $out = "Fail";
                    echo "<script type='text/javascript'> alert('Username Or Password Invalid!');</script>";
                }
                $stmt->close();
                $conn->close();
            }
        }
        ?>
    </body>
</html>

