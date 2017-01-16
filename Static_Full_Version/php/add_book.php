<?php
//include "email.php";
//require_once("TransactionManager.class.php");
require_once("SessionLoader.class.php");
//include '../model/TransactionManager.class.php';
//include '../controller/BookController.class.php';
//include "functions.php"; both included in email.php
session_start();
if (isset($_POST['title']) && isset($_SESSION['username'])){
    $_SESSION['loader']->getBookController()->addBook();
//    sendListEmail($isbn, $title, $publish_date, $authors, $course1, $book_condition, $notes, $price); 
}
echo '';
?>
