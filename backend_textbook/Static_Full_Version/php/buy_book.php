<?php
include 'functions.php';
session_start();
if(isset($_POST['bookID'])){   
    buyBook($_SESSION['username'],$_POST['bookID']);
    echo '';
    
}

?>