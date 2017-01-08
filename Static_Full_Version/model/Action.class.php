<?php

class Action{
    
    private $action;
    private $icon; 
    private $link;
    private $time;
    private $looked;
    public function __construct($action, $icon, $link, $time, $looked){
        $this->action = $action;
        $this->icon = $icon;
        $this->link = './myAccount.php'.$link;
        $this->time = $time;
        $this->looked = $looked;
    }
    public function getAction(){
        return $this->action;
    }
    public function getIcon(){
        return $this->icon;
    }
    public function getLink(){
        return $this->link;
    }
    public function getTime(){
        return $this->time;
    }
    public function getLooked(){
        return $this->looked;
    } 
}
?>
