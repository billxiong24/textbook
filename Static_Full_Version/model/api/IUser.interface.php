<?php
interface IUser{
    function getUserInfo();
    function getSellerInfo($seller);
    function addUser($name, $phone, $email);
    function updateUserInfo($name, $phone, $email);
}
?>
