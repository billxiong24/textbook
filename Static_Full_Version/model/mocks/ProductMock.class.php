<?php
require_once("ProductManager.class.php");
class ProductMock extends SuperManager implements IProduct{
    private $data;

    public function __construct($user, $data = array()){
        parent::__construct($user);
        $this->data = $data;
    }
    public function getData(){
        return $this->data;
    }    
    public function addBook($book){
        $this->data[$book->getID()] = $book;
    }
    public function removeListing($book_id){
        unset($this->data[$book_id]);
    }
    public function getCurrentListings(){
        $listings = array();
        foreach($this->data as $key=>$value){
            if($value->getUsername() == parent::getUser()){
                $listings[$key] = $value;
            }
        }
        return $listings;
    }
    public function getBook($id){
        return $this->data[$id];
    }
}
?>
