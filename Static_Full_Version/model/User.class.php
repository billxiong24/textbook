<?php
class User{
    private $username;
    private $name;
    private $phone;
    private $email;
    public function __construct($username, $name, $phone, $email) {
        $this->username = $username;
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
    }
    public function getUsername(){
        return $this->username;
    }
    public function getName(){
        return $this->name;
    }
    public function getPhone(){
        return $this->phone;
    }
    public function getEmail(){
        return $this->email;
    }
}
?>
