<?php
require_once("Book.class.php");
class BookTransaction{
    private $id;
    private $book;
    private $buyer;
    private $seller;
    public function construct($book, $buyer, $seller, $id = -1){
        $this->book = $book;
        $this->buyer = $buyer;
        $this->seller = $seller;
        $this->id = $id;
    }
    public function getBook(){
        return $this->book;
    } 
    public function getBuyer(){
        return $this->buyer;
    }
    public function getSeller(){
        return $this->seller;
    }
    public function getID(){
        return $this->id;
    }
    public function getTitle(){
        return $this->book->getTitle();
    }
    public function getPrice(){
        return $this->book->getPrice();
    }
}
?>
