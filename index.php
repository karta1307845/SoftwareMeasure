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
        <header>
            <div>
                <div class="header-title"><a class="navbar-brand" href="index.php"><h2>軟體分析</h2></a></div>
                <div class="header-en">SOFTWARE ANALYSIS</div>
            </div>
        </header>
        
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="#theme">系統主題</a></li>
                <li class="nav-item"><a class="nav-link" href="#analysis">系統分析與設計</a></li>
                <li class="nav-item"><a class="nav-link" href="#tool">使用技術和工具</a></li>
                <li class="nav-item"><a class="nav-link" href="#source">資料來源</a></li>
                <li class="nav-item"><a class="nav-link" href="#member">組員及分工</a></li>
                <li class="nav-item"><a class="nav-link" href="#code">程式碼</a></li>
            </ul>
            
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
        
        <!-- section1 -->
        <div class="container-fluid" id="theme" style="height:400px;">
            
        </div><hr class="section-divider">

        <!-- section2 -->
        <div class="container-fluid" id="analysis" style="height:400px;">
            
        </div><hr class="section-divider">

        <!-- section3 -->
        <div class="container-fluid" id="tool" style="height:400px;">
            
        </div><hr class="section-divider">

        <!-- section4 -->
        <div class="container-fluid" id="source" style="height:400px;">
            
        </div><hr class="section-divider">

        <!-- section5 -->
        <div class="container-fluid" id="member" style="height:400px;">
            
        </div><hr class="section-divider">

        <!-- section6 -->
        <div class="container-fluid" id="code" style="height:400px;">
            
        </div>

        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">&copy; 2019 Copyright</a></div>
        <!-- Copyright -->
    </body>
</html>