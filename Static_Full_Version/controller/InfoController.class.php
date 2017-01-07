<?php
require_once("AccountManager.class.php");
require_once("UserManager.class.php");
class InfoController{
    private $user;
    private $account_manager;
    private $user_manager;
    public function __construct($user){
        $this->user = $user;    
        $this->account_manager = new AccountManager($user);
        $this->user_manager = new UserManager($user);
    }

}
?>
