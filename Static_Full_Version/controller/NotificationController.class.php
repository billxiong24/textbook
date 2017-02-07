<?php
require_once("NotificationManager.class.php");
require_once("ActionFactory.class.php");
require_once("NotificationView.class.php");
class NotificationController{

    private $notif_manager;
    private $user;
    private $display;
    public function __construct($user, $notif_man, $notif_view){
        $this->notif_manager = $notif_man;
        $this->user = $user;
        $this->display = $notif_view;
    }
    public function getNotifications(){
        $result = $this->notif_manager->getNotifications();
        $actionFactory = new ActionFactory();
        $notifications = "";
        $unread = 0;
        $count = 0;
        $length = count($result);
        for ($i = 0, $lim = 0; $i < $length && $lim < 5; $i++){
            $lim++;
            $unread = $result[$i]->getLooked()  == 0 ? $unread + 1 : $unread; 
            $time = $this->notif_manager->time_elapsed_string($result[$i]->getTime());
            $action = $actionFactory->getAction($result[$i]->getAction(), $time, $result[$i]->getLooked());
            $notifications .= $this->display->displayNotification($action, $result[$i]->getTitle(), $result[$i]->getPrice());
        }
        $notifications .= $this->display->displaySeeAll();
        return array("unread"=>$unread, "notifications"=>$notifications);
    }
    public function getColorNotifs(){
        $result = $this->notif_manager->getNotifications();
        $actionFactory = new ActionFactory();
        $notifications = "";
        foreach($result as $notif){
            $time = $this->notif_manager->time_elapsed_string($notif->getTime());
            $action = $actionFactory->getAction($notif->getAction(), $time, $notif->getLooked(), Action::getColorMap()[$notif->getAction()]);
            $notifications .= $this->display->displayAllNotifs($action, $notif->getTitle(), $notif->getPrice());
        }
        return $notifications; 
    } 
    public function readNotifications(){
        $this->notif_manager->readNotifications();
    } 
}
?>
