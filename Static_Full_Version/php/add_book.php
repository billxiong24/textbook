<?php
//include "email.php";
//require_once("TransactionManager.class.php");
require_once("BookController.class.php");
//include '../model/TransactionManager.class.php';
//include '../controller/BookController.class.php';
//include "functions.php"; both included in email.php
session_start();
if (isset($_POST['title']) && isset($_SESSION['username'])){
    $_SESSION['book_controller']->addBook();
//    sendListEmail($isbn, $title, $publish_date, $authors, $course1, $book_condition, $notes, $price); 
}
echo '';
?>
