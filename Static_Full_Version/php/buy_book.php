<?php
//include 'email.php';
//include '../model/ProductManager.class.php';
//include '../model/TransactionManager.class.php';
require_once("BookController.class.php");
//include 'functions.php'; included in email.php
session_start();
if(isset($_POST['bookID']) && isset($_SESSION['username'])){
    $book =  $_SESSION['book_controller']->buyBook($_POST['bookID']);
    $_SESSION['seller'] = $book['seller'];
    echo '';
}
?>
