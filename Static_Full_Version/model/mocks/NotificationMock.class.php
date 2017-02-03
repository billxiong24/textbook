<?php
require_once("NotificationManager.class.php");
class NotificationMock extends SuperManager implements INotification{
    private $data;
    public function __construct($user, $data = array()){
        parent::__construct($user);
        $this->data = $data;
    }
    public function addNotification($notification){
        array_push($this->data, $notification);
    }
    public function readNotifications(){
        for($i = 0; $i < count($this->data); $i++){
            if($this->data[$i]->getUsername() == parent::getUser()){
                $this->data[$i]->changedLooked();
            }
        }
    }
    public function getNotifications(){
        $notifs = array();
        for($i = 0; $i < count($this->data); $i++){
            if($this->data[$i]->getUsername() == parent::getUser()){
                array_push($notifs, $this->data[$i]);
            }
        }
        return $notifs;
    }
    public function getAllNotifs(){
        $notifs = array();
        for($i = 0; $i < count($this->data); $i++){
            array_push($notifs, $this->data[$i]);
        }
        return $notifs;
    }
    public function time_elapsed_string($time){
        return null;
    }
} 
?>
