<?php
include 'functions.php';
session_start();
echo json_encode(search($_SESSION['search'],$_POST['price'],$_POST['condition']));

?>