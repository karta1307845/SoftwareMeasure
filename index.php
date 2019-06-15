<?php

session_start();
?>

<html>
    <head>
        <title>Main Page</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

        <!-- Icon library -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/nav_style.css">
    </head>
    <body>
        <nav class="navbar navbar-expand-sm bg-dark fixed-top">
            <a class="navbar-brand" href="index.php"><i class="fa fa-home fa-1x"></i></a>
            <ul class="navbar-nav ml-auto">
                <!-- Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">列表</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="action_index.php">新增專案</a>
                        <a class="dropdown-item" href="action_file.php">上傳檔案</a>
                    </div>
                </li>
                <?php
                if ( isset($_SESSION['loggedin']) ) {
                    if ( $_SESSION['loggedin'] ) {
                        echo '<li class="navbar-text"><i class="fa fa-user fa-1x mr-1"></i>';
                        echo "你好! ";
                        echo '<u>';
                        echo "{$_SESSION['username']}";
                        echo '</u></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="logout.php"><i class="fa fa-sign-out fa-1x mr-1"></i>登出</a></li>';
                    }
                } else { 
                    echo '<li class="nav-item"><a class="nav-link" href="login.php"><i class="fa fa-sign-in fa-1x mr-1"></i>登入</a></li>';
                }
                ?>
            </ul>
        </nav>     
    </body>
</html>