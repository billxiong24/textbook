<?php
include 'functions.php';
include 'email.php';
session_start();
if(isset($_POST['bookID'])){
	$book = getBook($_POST['bookID']);
	sendBoughtEmail($book, date("F j, Y") . " at " . date("g:i a"));
	sendSoldEmail($book, date("F j, Y") . " at " . date("g:i a"));
    buyBook($_SESSION['username'],$_POST['bookID']);
    echo '';
}
?>