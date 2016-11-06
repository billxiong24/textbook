<?php
include 'functions.php';
session_start();
echo search($_SESSION['search'],$_POST['price'],$_POST['condition']);


?>