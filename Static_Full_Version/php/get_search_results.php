<?php
include 'functions.php';
require_once("SearchController.class.php");
session_start();

//echo json_encode(search($_SESSION['search'],$_POST['price'],$_POST['condition']));
if(!isset($_SESSION['search_controller'])){
$search = new SearchController(null);
echo json_encode($search->search($_SESSION['search'],$_POST['price'],$_POST['condition']));
unset($search);
}
else{
echo json_encode($_SESSION['search_controller']->search($_SESSION['search'],$_POST['price'],$_POST['condition']));
}

?>
