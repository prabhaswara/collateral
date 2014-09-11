<?php
session_start();
unset($_SESSION['colateral']);
header('location:login.php');
?>
