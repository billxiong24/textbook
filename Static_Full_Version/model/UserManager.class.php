<?php
include_once 'SuperManager.class.php';
include_once 'DataBase.class.php';
require_once('UserBuilder.class.php');
class UserManager extends SuperManager{

    public function __construct($user){
        parent::__construct($user);
    }
    public function getUserInfo(){
        DataBase::init();
        $query = "SELECT * FROM users WHERE username = '".parent::getUser()."' ";
        $result = DataBase::make_query($query);
        $user = new UserBuilder();
        return $user->createFromQuery(mysqli_fetch_assoc($result));
    }
    public function getSellerInfo($seller){
        DataBase::init();
        $query = "SELECT * FROM users WHERE username = '".$seller."' ";
        $result = DataBase::make_query($query);
        $user = new UserBuilder();
        return $user->createFromQuery(mysqli_fetch_assoc($result));
    }
    public function addUser($name,$phone_num,$email){
        DataBase::init();
        $username =  DataBase::escape(parent::getUser());
        $name =  DataBase::escape($name);
        $phone_num =  DataBase::escape($phone_num);
        $email =  DataBase::escape($email);
        $query = 'INSERT INTO users(username,name,phone_num,email) '; 
        $query .= "VALUES ('$username','$name','$phone_num','$email')"; 
        DataBase::make_query($query);
    }

    public function updateUserInfo($name, $phone_num, $email){
        DataBase::init();
        $query = "UPDATE users SET name = '$name', phone_num = '$phone_num', email = '$email' WHERE username = '".parent::getUser()."' ";
        DataBase::make_query($query);
    }
}
?>
