<?php
session_start();
unset($_SESSION['user_log']);
unset($_SESSION['user_name']);
unset($_SESSION['user_role']);
unset($_SESSION['user_id']);
header("location:../../index.php");
?>