<?php
class Prod{
    private $id;
    public function __construct($id){
        $this->id = $id;
    }

    public function checkID(){
        return $this->id > 0 ? 1 : 0;
    }
}
?>
