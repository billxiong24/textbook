<?php

$connection = mysqli_connect('localhost','root','bill1313','loginapp');
if(!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
}

?>