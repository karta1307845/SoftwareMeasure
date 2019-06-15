<?php
// You'd put this code at the top of any "protected" page you create

// Always start this first
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

        <link rel="stylesheet" href="css/navbar_style.css">
    </head>
    <body>
        <nav class="navbar navbar-expand-sm bg-light fixed-top">
            <a class="navbar-brand" href="main.php">Logo</a>
                <?php
                if ( isset($_SESSION['loggedin']) ) {
                    if ( $_SESSION['loggedin'] ) {
                        echo '<span class="navbar-text"><h6>';
                        echo "你好! ";
                        echo '<u>';
                        echo "{$_SESSION['username']}";
                        echo '</u>';
                        echo ", 你的ID是 {$_SESSION['id']}";
                        echo '</h6></span>';
                        echo '<ul class="navbar-nav ml-auto"><li class="nav-item"><a class="nav-link" href="logout.php">登出</a></li></ul>';
                    }
                } else {
                    echo '<ul class="navbar-nav ml-auto"><li class="nav-item"><a class="nav-link" href="login.php">登入</a></li></ul>';
                }
                ?>
        </nav>     
    </body>
</html>