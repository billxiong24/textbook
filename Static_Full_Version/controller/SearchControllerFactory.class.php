<?php
require_once("SearchManager.class.php");
require_once("SearchView.class.php");
require_once("SearchController.class.php");
require_once("ControllerFactory.class.php");
class SearchControllerFactory extends ControllerFactory{
        
    public function __construct(){
        parent::__construct();
    }
    public function createController($user){
        $search_man = new SearchManager($user);
        $search_view = new SearchView();
        return new SearchController($user, $search_man, $search_view);
    }
}
?>
