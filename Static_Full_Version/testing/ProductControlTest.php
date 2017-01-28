<?php
require_once("Prod.php");
class ProductControlTest extends PHPUnit_Framework_TestCase{
    
    public function __construct(){
        
    }
    public function setUp(){
        parent::setUp();
    }

    public function tearDown(){
        parent::tearDown();
    }
    public function testCheckID(){
        $prod = new Prod(4);
        $this->assertTrue($prod->checkID() > 0);
    }
}
?>
