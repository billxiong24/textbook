<?php
require_once("ControllerFactory.class.php");
require_once("NotificationView.class.php");
require_once("NotificationManager.class.php");
require_once("NotificationController.class.php");
class NotificationControllerFactory extends ControllerFactory{

    public function __construct(){
        parent::__construct();
    }
    public function createController($user){
        $notif_man = new NotificationManager($user);
        $notif_view = new NotificationView();
        return new NotificationController($user, $notif_man, $notif_view);
    }
}
?>
