<?php
require_once("NotificationManager.class.php");
require_once("ActionFactory.class.php");
require_once("Display.class.php");
class NotificationController{

    private $notif_manager;
    private $user;
    private $display;
    public function __construct($user){
        $this->notif_manager = new NotificationManager($user);
        $this->user = $user;
        $this->display = new Display();
    }
    public function getNotifications(){
        $result = $this->notif_manager->getNotifications();
        $actionFactory = new ActionFactory();
        $notifications = "";
        $unread = 0;
        $count = 0;
        while(($notif = mysqli_fetch_assoc($result)) && $count < 5){
            $count++;
            $unread = $notif['looked_at'] == 0 ? $unread + 1 : $unread; 
            $time = $this->notif_manager->time_elapsed_string($notif['timestamp']);
            $action = $actionFactory->getAction($notif['action'], $time, $notif['looked_at']);
            $notifications .= $this->display->displayNotification($action, $notif['title'], $notif['price']);
        }
        $notifications .= $this->display->displaySeeAll();
        return array("unread"=>$unread, "notifications"=>$notifications);
    }
    public function readNotifications(){
        $this->notif_manager->readNotifications();
    } 
}
?>
