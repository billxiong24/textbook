<?php

$connection = mysqli_connect('localhost','root','bill1313','textbook');
if(!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
}

?>