<?php
//include 'email.php'; // functions.php and session_start included in email.php
//include '../model/ProductManager.class.php';
//include '../model/TransactionManager.class.php';
require_once("BookController.class.php");
session_start();
if(isset($_POST['purchaseID']) && isset($_SESSION['username'])){
    $_SESSION['book_controller']->cancelPurchase($_POST['purchaseID']);
    //sendCancelEmail($transaction);
}
echo '';

?>
