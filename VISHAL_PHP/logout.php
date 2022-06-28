<?php
session_start();
unset($_SESSION['email1']);
unset($_SESSION['user1']);
unset($_SESSION['id1']);
header("Location:home.php");
?>