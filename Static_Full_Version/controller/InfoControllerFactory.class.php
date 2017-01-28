<?php
require_once("ControllerFactory.class.php");
require_once("AccountManager.class.php");
require_once("UserManager.class.php");
require_once("AccountView.class.php");
require_once("InfoController.class.php");
class InfoControllerFactory extends ControllerFactory{

    public function __construct(){
        parent::__construct();
    }
    public function createController($user){
        $acc = new AccountManager($user);
        $user_man = new UserManager($user);
        $account_view = new AccountView();
        return new InfoController($user, $acc, $user_man, $account_view);
    }
}
?>
