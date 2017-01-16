<?php
//include 'email.php';
//include '../model/ProductManager.class.php';
//include '../model/TransactionManager.class.php';
require_once("SessionLoader.class.php");
//include 'functions.php'; included in email.php
session_start();
if(isset($_POST['bookID']) && isset($_SESSION['username'])){
    $seller =  $_SESSION['loader']->getBookController()->buyBook($_POST['bookID']);
    $_SESSION['seller'] = $seller;
    echo '';
}
?>
