<?php

$connection = mysqli_connect('localhost','root','Chem1313#','textbook_exchange');
if(!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
}

?>
