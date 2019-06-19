<!DOCTYPE html>
<html>

<head>
    <title>Register Page</title>
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
                <!-- Material form login -->
                <div class="card">
                    <h1 class="text-center py-4"><b>加入會員</b></h1>
                    <div class="card-body px-lg-5 py-0">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                            <label for="uname">電子郵件</label><span id = "must">*</span><br>
                            <input type="email" class="form-control mb-2 mr-sm-2" name="email"
                                value="<?php if (empty($_POST["username"])) {echo "";} else { echo $_POST["email"]; }?>" placeholder="請輸入電子郵件" required>
                            <label for="uname">帳號</label><span id = "must">*</span><br>
                            <input type="text" class="form-control mb-2 mr-sm-2" name="username"
                                value="<?php if (empty($_POST["username"])) {echo "";} else { echo $_POST["username"]; }?>" placeholder="請輸入帳號" required>
                            <label for="pwd">密碼</label><span id = "must">*</span><br>
                            <input type="password" class="form-control mb-2 mr-sm-2" name="password"
                                value="<?php if (empty($_POST["username"])) {echo "";} else { echo $_POST["password"]; }?>" placeholder="請輸入密碼" required><br>
                            <div class="row">
                                <div class="col-sm-5"></div>
                                <div class="col-sm-7 text-right">
                                    <div>
                                        <a href="login.php">回到會員登入</a>
                                    </div>
                                </div>
                            </div>

                            <input type="submit" class="btn btn-success my-4 btn-block btn-lg" value="加入"><br>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3"></div>
    </div>

    <?php

    session_start();

    if ( ! empty( $_POST ) ) {
        if ( isset( $_POST['email'] ) && isset( $_POST['username'] ) && isset( $_POST['password'] )) {
            // 連接資料庫會用到的變數
            $servername = "localhost";
            $db_username = "username";
            $db_password = "password";
            $dbname = "myDB";

            $conn = new mysqli ($servername, $db_username, $db_password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $stmt = $conn->prepare("SELECT username FROM users WHERE username = ?");
            $stmt->bind_param('s', $_POST['username']);
            $stmt->execute();
            $result = $stmt->store_result();
            
            if($stmt->num_rows == 1) { //To check if the row exists
                while($stmt->fetch()) { //fetching the contents of the row
                    echo "<script type='text/javascript'> alert('Username has been used!');</script>";
                }
            } else {
                $sql = "INSERT INTO users (email, username, user_password) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('sss', $_POST['email'], $_POST['username'], $_POST['password']);
                $stmt->execute();

                mkdir("upload/" . $stmt->insert_id);  // 建立資料夾，用來存放該使用者上傳的檔案

                echo "<script type='text/javascript'> alert('註冊成功!'); window.location.href='login.php' </script>";
                exit();
            }
            $stmt->close();
            $conn->close();
        }
    }
    ?>
</body>

</html>

