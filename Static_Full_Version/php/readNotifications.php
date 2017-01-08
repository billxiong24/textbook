<?php
//include 'functions.php';
require_once("NotificationController.class.php");
session_start();
$_SESSION['notif_controller']->readNotifications();
echo '';

?>
