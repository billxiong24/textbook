<?php
interface INotification{
    function addNotification($user, $action, $title, $price);
    function readNotifications();
    function getNotifications();
    function time_elapsed_string($time);
} 
?>
