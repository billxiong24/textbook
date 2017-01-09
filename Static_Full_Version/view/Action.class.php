<?php

class Action{
    //TODO subclass this cancer
    
    private static $colorMap = array('Bought'=>'#FFCC11', 'Someone bought'=>'#00b16A', 'Added listing'=>'#19B5FE', 'Canceled purchase'=>'#EF4836');
    private $action;
    private $icon; 
    private $link;
    private $time;
    private $looked;
    private $color;
    public function __construct($action, $icon, $link, $time, $looked, $color){
        $this->action = $action;
        $this->icon = $icon;
        $this->link = './myAccount.php'.$link;
        $this->time = $time;
        $this->looked = $looked;
        $this->color = $color;
    }
    public static function getColorMap(){
        return self::$colorMap;
    }
    public function getColor(){
        return $this->color;
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
