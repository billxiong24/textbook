<?php
require_once("TransactionManager.class.php");
class TransactionMock extends SuperManager implements ITransaction{
    
    private $data;  
    public function __construct($user, $data = array()){
        parent::__construct($user);
        $this->data = $data;
    }

    public function buyBook($book, $book_id){
        $trans = new BookTransaction($book, parent::getUser(), $book->getUsername(), time());
        $this->data[$book_id] = $trans;
    }
    public function cancelPurchase($purchase_id){
        unset($this->data[$book_id]);
    }
    public function boughtBooks(){
        $bought = array();
        foreach($this->data as $key=>$value){
            if($value->getBuyer() == parent::getUser()){
                $bought[$key] = $value;
            }
        }
        return $bought;
    }
    public function soldBooks(){
        $sold = array();
        foreach($this->data as $key=>$value){
            if($value->getSeller() == parent::getUser()){
                $sold[$key] = $value;
            }
        }
        return $sold;
    }
    public function findBookHistory($id){
        return $this->data[$id]->getBook();
    }
}
?>
