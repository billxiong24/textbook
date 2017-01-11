<?php
require_once("Book.class.php");
class BookTransaction{
    private $id;
    private $book;
    private $buyer;
    private $seller;
    private $trans_date;
    public function __construct($book, $buyer, $seller, $trans_date, $id = -1){
        $this->book = $book;
        $this->buyer = $buyer;
        $this->seller = $seller;
        $this->trans_date = $trans_date;
        $this->id = $id;
    }
    public function getTransDate(){
        return $this->trans_date;
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
}
?>
