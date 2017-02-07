<?php
abstract class ControllerFactory{
    
    public function __construct(){

    }
    public abstract function createController($user);
}
?>
