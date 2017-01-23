<?php
require_once("BookController.class.php");
require_once("InfoController.class.php");
require_once("NotificationController.class.php");
require_once("SearchController.class.php");

class SessionLoader{
    private $book_controller;
    private $info_controller;
    private $notif_controller;
    private $search_controller;

    public function __construct($user){
        $this->book_controller = new BookController($user);
        $this->info_controller = new InfoController($user);
        $this->notif_controller = new NotificationController($user);
        $this->search_controller = new SearchController($user);
    }
    public function getBookController(){
        return $this->book_controller;
    }
    public function getInfoController(){
        return $this->info_controller;
    }
    public function getNotifController(){
        return $this->notif_controller;
    }
    public function getSearchController(){
        return $this->search_controller;
    }
}
?>
