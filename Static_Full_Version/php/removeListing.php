<?php
//include 'functions.php';
//include '../model/TransactionManager.class.php';
require_once("SessionLoader.class.php");
//require_once("../controller/BookController.class.php");
//require_once("TransactionManager.class.php");
session_start();
if(isset($_POST['listingID'])){
    $_SESSION['loader']->getBookController()->removeListing($_POST['listingID']);
}
echo '';

?>
