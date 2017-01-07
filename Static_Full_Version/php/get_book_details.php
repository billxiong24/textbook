<?php
//include 'functions.php';

//include '../model/ProductManager.class.php';
require_once("BookController.class.php");
session_start();
if(isset($_POST['bookID'])){  
    echo json_encode($_SESSION['book_controller']->getBookDetails($_POST['bookID']));
}




?>
