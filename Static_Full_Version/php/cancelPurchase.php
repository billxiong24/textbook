<?php
//include 'email.php'; // functions.php and session_start included in email.php
//include '../model/ProductManager.class.php';
//include '../model/TransactionManager.class.php';
require_once("SessionLoader.class.php");

session_start();
if(isset($_POST['purchaseID']) && isset($_SESSION['username'])){
    $_SESSION['loader']->getBookController()->cancelPurchase($_POST['purchaseID']);
    //sendCancelEmail($transaction);
    //echo json_encode(array("test"=>24));
}
echo '';
?>
