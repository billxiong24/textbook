<?php
require_once("User.class.php");
class UserBuilder{
    private $username;
    private $name;
    private $phone;
    private $email;

    public function username($username){
        $this->username = $username;
        return $this;
    }
    public function name($name){
        $this->name = $name;
        return $this;
    }
    public function phone($phone){
        $this->phone = $phone;
        return $this;
    }
    public function email($email){
        $this->email = $email;
        return $this;
    }
    public function create(){
        return new User($this->username, $this->name, $this->phone, $this->email);
    }
    public function createFromQuery($query){
        $this->username($query['username'])->name($query['name'])->email($query['email'])->phone($query['phone_num']);
        return $this->create();
    }
}
?>
