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
    public function getAccountOverview($boughtBooks, $soldBooks){
       return $this->account_manager->accountOverview2($boughtBooks, $soldBooks);
    }
    public function getUserInfo($user = null){
        return  $user == null ? $this->user_manager->getUserInfo() : $this->user_manager->getSellerInfo($user);
    }
    public function updateUserInfo($name, $phone_num, $email){
        $this->user_manager->updateUserInfo($name, $phone_num, $email);
    }
    public function addUser($name, $phone_num, $email){
        $this->user_manager->addUser($name, $phone_num, $email);
    }

}
?>
