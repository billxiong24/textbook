<?php
include 'functions.php';
include 'email.php';
session_start();
if(isset($_POST['bookID'])){
	$book = getBook($_POST['bookID']);
	sendBoughtEmail($book, time());
    buyBook($_SESSION['username'],$_POST['bookID']);
    echo '';
}



?>