<?php
class Notification{
    private $username;
    private $action;
    private $looked;
    private $time;
    private $title;
    private $price;
    public function __construct($username, $action, $looked, $time, $title, $price){
        $this->username = $username;
        $this->action = $action;
        $this->looked = $looked;
        $this->time = $time;
        $this->title = $title;
        $this->price = $price;
    }
    public function getUsername(){
        return $this->username;
    }
    public function getAction(){
        return $this->action;
    }
    public function getLooked(){
        return $this->looked;
    }
    public function getTime(){
        return $this->time;
    }
    public function getTitle(){
        return $this->title;
    }
    public function getPrice(){
        return $this->price;
    }
    public function changedLooked(){
        $this->looked = 1;
    }
}
?>
