<?php

$connection = mysqli_connect('localhost','root','bill1313','textbook_exchange');
if(!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
}

?>