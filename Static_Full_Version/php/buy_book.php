<?php
include 'email.php';
//include 'functions.php'; included in email.php
//session_start();
if(isset($_POST['bookID'])){
    buyBook($_SESSION['username'],$_POST['bookID']);
	$book = findBookHistory($_POST['bookID']);
	sendBoughtEmail($book);
	sendSoldEmail($book);
    $_SESSION['seller'] = $book['seller'];
    echo '';
}
?>