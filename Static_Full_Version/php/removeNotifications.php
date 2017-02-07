<?php
include "functions.php";
session_start();
if(!isset($_SESSION['username'])){
    header('Location: index.php');
}
$account = accountOverview($_SESSION['username']);
$user = getUser($_SESSION['username']);


function removeNotifications($username){
	global $connection;
	$query = "SELECT * FROM notifications WHERE username = '$username'";
    $result = mysqli_query($connection,$query);
    if(!$result){
        die('Query Failed' . mysqli_error($connection));
    }  
    //echo $_POST['index'];

/*    $arr = mysqli_fetch_all ($result, MYSQLI_NUM);
    echo $_POST['ind'];
    $id = $arr[count($arr) - 1 - $_POST['ind']][0]; //id
    $id2 = $arr[4][0];
    echo $id2;
    echo $id; */
}

removeNotifications($_SESSION['username']);

?>