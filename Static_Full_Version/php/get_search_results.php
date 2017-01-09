<?php
include 'functions.php';
require_once("SearchController.class.php");
session_start();
echo json_encode($_SESSION['search_controller']->search($_SESSION['search'],$_POST['price'],$_POST['condition']));

?>
