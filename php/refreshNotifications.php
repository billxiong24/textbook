<?php
include 'functions.php';
session_start();
echo json_encode(getNotifications($_SESSION['username']));


?>