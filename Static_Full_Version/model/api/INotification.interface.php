<?php
interface INotification{
    function addNotification($notif);
    function readNotifications();
    function getNotifications();
    function time_elapsed_string($time);
}
?>
