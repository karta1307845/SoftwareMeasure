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

        <!-- Icon library -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/form_style.css">
    </head>
    <body style="background-color:whitesmoke;">
        <header>
            <div class="header-title"><a class="navbar-brand" href="index.php"><h2>軟體分析</h2></a></div>
            <div class="header-en">SOFTWARE ANALYSIS</div>
        </header><hr>
        <div class="container">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6 center">
                    <div class="card">
                        <h1 class="text-center py-4"><b>會員登入</b></h1>
                        <div class="card-body px-lg-5 pt-0">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                            
                                <label for="uname">帳號</label><br>
                                <input type="text" class="form-control mb-2 mr-sm-2" name="username" value="<?php if (empty($_POST["username"])) {echo "";} else { echo $_POST["username"]; }?>" placeholder="請輸入帳號" required>
                                <label for="pwd">密碼</label><br>
                                <input type="password" class="form-control mb-2 mr-sm-2" name="password" value="<?php if (empty($_POST["username"])) {echo "";} else { echo $_POST["password"]; } ?>" placeholder="請輸入密碼" required><br>
                                <div class="row">
                                    <div class="col-sm-5"></div>
                                    <div class="col-sm-7 text-right">
                                        <div>
                                            <p>還不是會員? <a href="register.php">加入會員</a></p>
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-info my-4 btn-block btn-lg" value="登入">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3"></div>
            </div>
        </div>

        <?php

        session_start();
        include "database_field.php";

        if ( ! empty( $_POST ) ) {
            if ( isset( $_POST['username'] ) && isset( $_POST['password'] )) {
                $conn = new mysqli ($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT id FROM users WHERE username = ? AND user_password = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('ss', $_POST['username'], $_POST['password']);
                $stmt->execute();
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    $stmt->bind_result($id);
                    $stmt->fetch();
                    //Verify username first. if username exist, then verify the password
                    //session_regenerate_id();
                    $_SESSION['loggedin'] = TRUE;
                    $_SESSION['username'] = $_POST['username'];
                    $_SESSION['id'] = $id;
                    echo "<script type='text/javascript'> location.href='index.php'; </script>";
                    exit;
                } else {
                    echo "<script type='text/javascript'> alert('帳號或密碼錯誤!');</script>";
                }
                $stmt->close();
                $conn->close();
            }
        }
        ?>
    </body>
</html>

