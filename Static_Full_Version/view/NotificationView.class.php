<?php
require_once("Action.class.php");
class NotificationView{

    public function displayNotification($action, $title, $price){
        $act = $action->getAction();
        $info = "{$act} {$title} for \${$price}";
        if(strlen($info) >= 38){
            $info = substr($info, 0, 37);
            $info = $info . '...';
        }
        $color = $action->getLooked() ? '#535353' : 'darkred';
        return "<li>
                <a href='".$action->getLink()."'>
                    <div style='color: ".$color."; background-color: white;'>
                        <i class='".$action->getIcon()." fa-fw'></i> {$info}
                        <span style='color: ".$color.";'class='pull-right text-muted small'>{$action->getTime()}</span>
                    </div>
                </a>
            </li>
            <li class='divider'></li>";
    }
    public function displayAllNotifs($action, $title, $price){
        $header = $action->getAction();
        $color = $action->getColor();
        $icon = $action->getIcon();
        $link = $action->getLink(); 
        $time = $action->getTime();
        $info = "{$header} {$title} for \${$price}";
        return "<div class='vertical-timeline-block'>
                <div class='vertical-timeline-icon' style='color: #fff; background-color: $color'>
                <i class='$icon'></i>
                </div>
                <div class='vertical-timeline-content'>
                <h2>{$header}</h2>
                <p class='query-message'>{$info}
                </p>
                
                <a class='btn btn-sm btn-primary' href='$link'>Details</a>
                <span class='vertical-date'>
                <br/>
                <small>{$time}</small>
                </span>
                </div>
                </div>";
    }
    public function displaySeeAll(){
        return "<li>
            <div class='text-center link-block notif-color' style='background-color: #001A57; opacity: 0.9'>
                <a href='notifications.php'>
                    <strong>See All Alerts</strong>
                    <i class='fa fa-angle-right'></i>
                </a>
            </div>
        </li>";                               
    
    }
}
?>
