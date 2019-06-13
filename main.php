<?php
// You'd put this code at the top of any "protected" page you create

// Always start this first
session_start();

if ( isset( $_SESSION['id'] ) ) {
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
    echo "Hello! {$_SESSION['username']}";
} else {
    // Redirect them to the login page
    echo "<script language='javascript' type='text/javascript'> location.href='login.php' </script>";
}
?>

<html>
    <head>
        <title>Main Page</title>
        <meta charset="utf-8">
    </head>
    <body>
        <h3><a href="logout.php">Logout</a></h3>        
    </body>
</html>