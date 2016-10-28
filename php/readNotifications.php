<?php
include 'functions.php';
session_start();
readNotifications($_SESSION['username']);
echo '';

?>