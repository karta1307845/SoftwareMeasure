<?php
session_start();

if (isset($_SESSION["id"])) {
    header("Location: ./index.html");
    exit;
} else {
    header("Location: ./login.php");
}
