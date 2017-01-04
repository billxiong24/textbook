<?php
include 'email.php'; // functions.php and session_start included in email.php

if(isset($_POST['purchaseID']) && isset($_SESSION['username'])){
    $transaction = findBookHistory($_POST['purchaseID']);
    sendCancelEmail($transaction);
    cancelPurchase($_POST['purchaseID']);   
}
echo '';

?>