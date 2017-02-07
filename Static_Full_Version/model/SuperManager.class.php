<?php
abstract class SuperManager{

    private $user;
    public function __construct($user){
        $this->user = $user;
    }
    protected function getUser(){
        return $this->user;
    }
}
?>

