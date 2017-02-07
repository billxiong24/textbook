<?php
require_once("ControllerFactory.class.php");
require_once ("TransactionManager.class.php");
require_once('ProductManager.class.php');
require_once("NotificationManager.class.php");
require_once("BookController.class.php");

class ProductControllerFactory extends ControllerFactory{

    public function __construct(){
        parent::__construct();
    }
    public function createController($user){
        $trans = new TransactionManager($user);
        $prod = new ProductManager($user);
        $notif = new NotificationManager($user);
        return new BookController($user, $trans, $prod, $notif);
    }
}
?>
