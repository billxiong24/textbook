<?php
require_once("Notification.class.php");
class NotificationBuilder{
    private $username;
    private $action;
    private $looked;
    private $time;
    private $title;
    private $price;

    public function username($username){
        $this->username = $username;
        return $this;
    }
    public function action($action){
        $this->action = $action;
        return $this;
    }
    public function looked($looked){
        $this->looked = $looked;
        return $this;
    }
    public function setTime($time){
        $this->time = $time;
        return $this;
    }
    public function title($title){
        $this->title = $title;
        return $this;
    }
    public function price($price){
        $this->price = $price;
        return $this;
    }
    public function create(){
        return new Notification($this->username, $this->action, $this->looked, $this->time, $this->title, $this->price);
    }
}
?>
