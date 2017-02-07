<?php
require_once('Action.class.php');
class ActionFactory{
    //TODO create suclasses for each one- too lazy right now
    public function getAction($action, $timestamp, $looked, $color = 'black'){
        $link = './myAccount.php';
        if($action == 'Bought'){
            return new Action($action, 'fa fa-shopping-cart', '#purchase-history', $timestamp, $looked, $color);
        }
        else if($action == 'Someone bought'){
            return new Action($action, 'fa fa-usd', '#sold', $timestamp, $looked, $color);
        }
        else if($action == 'Added listing'){
            return new Action($action, 'fa fa-plus', '#listings', $timestamp, $looked, $color);
        }
        else{
            return new Action($action, 'fa fa-ban', '#listings', $timestamp, $looked, $color);
        }

    }
}
?>
