<?php
//include 'functions.php';
require_once("SessionLoader.class.php");
session_start();
$_SESSION['loader']->getNotifController()->readNotifications();
echo '';

?>
