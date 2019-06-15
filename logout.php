<?php
session_start();
session_destroy();
echo "<script type='text/javascript'> alert('會員登出'); location.href='index.php'; </script>";
exit();
?>