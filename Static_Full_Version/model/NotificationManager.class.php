<?php
include_once 'DataBase.class.php';
include_once 'SuperManager.class.php';
class NotificationManager extends SuperManager{
    public function __construct($user){
        parent::__construct($user);
    }
    public function addNotification($user, $action,$title,$price){
        DataBase::init();
        $timestamp = time();
        $title = DataBase::escape($title);
        $query = "INSERT INTO notifications(username,action,timestamp,title,price) ";
        $query .= "VALUES('".$user."','$action',$timestamp,'$title',$price)";
        DataBase::make_query($query);
    }
    public function readNotifications(){ //called when a user clicks on the notifications tab and all are checked as read
        DataBase::init();
        $query = "UPDATE notifications SET looked_at = 1 WHERE username = '".parent::getUser()."' ";
        DataBase::make_query($query);
    }
    public function getNotifications(){
        DataBase::init(); 
        $query = "SELECT * FROM notifications WHERE username = '".parent::getUser()."' ORDER BY timestamp DESC";
        return DataBase::make_query($query);
    }
    public function time_elapsed_string($ptime)// time elapsed function from stackoverflow http://stackoverflow.com/questions/1416697/converting-timestamp-to-time-ago-in-php-e-g-1-day-ago-2-days-ago
    {
        $etime = time() - $ptime;

        if ($etime < 1){
            return '0 seconds';
        }

        $a = array( 365 * 24 * 60 * 60  =>  'year',
                     30 * 24 * 60 * 60  =>  'month',
                          24 * 60 * 60  =>  'day',
                               60 * 60  =>  'hour',
                                    60  =>  'minute',
                                     1  =>  'second'
                    );
        $a_plural = array( 'year'   => 'years',
                           'month'  => 'months',
                           'day'    => 'days',
                           'hour'   => 'hours',
                           'minute' => 'minutes',
                           'second' => 'seconds'
                    );

        foreach ($a as $secs => $str){
            $d = $etime / $secs;
            if ($d >= 1){
                $r = round($d);
                return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
            }
        }
    }
}
?>
