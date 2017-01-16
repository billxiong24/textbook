<?php
//include 'functions.php';

//include '../model/ProductManager.class.php';
require_once("SessionLoader.class.php");
session_start();
if(isset($_POST['bookID'])){  
    echo json_encode($_SESSION['loader']->getBookController()->getBookDetails($_POST['bookID']));
}




?>
