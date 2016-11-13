<?php

$connection = mysqli_connect('localhost','root','','textbook_exchange');
if(!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
}

?>
