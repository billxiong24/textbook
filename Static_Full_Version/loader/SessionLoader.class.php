<?php
require_once("SearchController.class.php");
require_once("ProductControllerFactory.class.php");
require_once("InfoControllerFactory.class.php");
require_once("NotificationControllerFactory.class.php");
require_once("SearchControllerFactory.class.php");
class SessionLoader{
    private $book_controller;
    private $info_controller;
    private $notif_controller;
    private $search_controller;

    public function __construct($user){
        $product_factory = new ProductControllerFactory();
        $info_factory = new InfoControllerFactory();
        $notif_factory = new NotificationControllerFactory();
        $search_factory = new SearchControllerFactory();
        $this->book_controller = $product_factory->createController($user);
        $this->info_controller = $info_factory->createController($user);
        $this->notif_controller = $notif_factory->createController($user);
        $this->search_controller = $search_factory->createController($user);
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
