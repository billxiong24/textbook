<?php
interface IUser{
    function getUserInfo();
    function getSellerInfo($seller);
    function addUser($name, $phone_num, $email);
    function updateUserInfo($user);
}
?>
