<?php
require_once("AccountManager.class.php");
require_once("UserManager.class.php");
require_once("AccountView.class.php");
class InfoController{
    private $user;
    private $account_manager;
    private $user_manager;
    private $account_view;
    public function __construct($user){
        $this->user = $user;    
        $this->account_manager = new AccountManager($user);
        $this->user_manager = new UserManager($user);
        $this->account_view = new AccountView();
    }
    public function getAccountOverview($boughtBooks, $soldBooks){
       return $this->account_manager->accountOverview($boughtBooks, $soldBooks);
    }
    public function getUserInfo($user = null){
        return  $user == null ? $this->user_manager->getUserInfo() : $this->user_manager->getSellerInfo($user);
    }
    public function updateUserInfo($user){
        $this->user_manager->updateUserInfo($user);
    }
    public function addUser($name, $phone_num, $email){
        $this->user_manager->addUser($name, $phone_num, $email);
    }
    public function displayBought($bought){
        $this->account_view->displayBought($bought);
    }
    public function displaySold($sold){
        $this->account_view->displaySold($sold);
    }
    public function displayCurrentListings($currentListings){
        $this->account_view->displayCurrentListings($currentListings);
    }
    public function getData($func){
        return call_user_func(array($this->account_manager, $func));
    }

}
?>
