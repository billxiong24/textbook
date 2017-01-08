<?php
//include 'functions.php';
require_once("NotificationController.class.php");
session_start();
//echo json_encode(getNotifications($_SESSION['username']));
echo json_encode($_SESSION['notif_controller']->getNotifications());
?>
