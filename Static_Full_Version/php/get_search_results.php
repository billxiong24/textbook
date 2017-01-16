<?php
//include 'functions.php';
require_once("SessionLoader.class.php");
session_start();

//echo json_encode(search($_GET['search'],$_GET['price'],$_GET['condition']));
if(!isset($_SESSION['loader'])){
    $search = new SearchController(null);
    echo json_encode($search->search($_SESSION['search'],$_GET['price'],$_GET['condition']));
    unset($search);
}
else{
    echo json_encode($_SESSION['loader']->getSearchController()->search($_SESSION['search'],$_GET['price'],$_GET['condition']));
}

?>
