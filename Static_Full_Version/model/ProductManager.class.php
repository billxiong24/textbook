<?php
include_once 'DataBase.class.php';
include_once 'NotificationManager.class.php';
include_once 'SuperManager.class.php';
require_once("BookBuilder.class.php");
require_once("BookTransaction.class.php");
/**
 * For now, this is manages books- extensible to other
 * produts as well
 */
class ProductManager extends SuperManager{
    private $notif_manager;
    public function __construct($user){
        parent::__construct($user);
        $this->notif_manager = new NotificationManager($user);
    }

    public function getCurrentListings(){
        DataBase::init();
        $listings = array();
        $query = "SELECT * FROM books WHERE username = '".parent::getUser()."'";
        $result = DataBase::make_query($query);
        $builder = new BookBuilder();
        while ($book = mysqli_fetch_assoc($result)){
            array_push($listings, $builder->createFromQuery($book));
        }
        return array_reverse($listings);  // first books are most recent
    }

    public function getBook($id){
        DataBase::init();
        $id = intval($id);
        $query = "SELECT * FROM books WHERE id = $id";
        $book = DataBase::make_query($query);
        $bookbuilder = new BookBuilder();
        return $bookbuilder->createFromQuery(mysqli_fetch_assoc($book));
    }
    
    public function boughtBooks(){
        DataBase::init();
        $boughtBooks = array();
        $query = "SELECT * FROM transaction_history WHERE buyer = '".parent::getUser()."' ORDER BY trans_date DESC";
        $result = DataBase::make_query($query);
        $bookbuilder = new BookBuilder();

        while ($book = mysqli_fetch_assoc($result)){
            $book_construct = $bookbuilder->createBookFromTransaction($book);
            $trans = new BookTransaction($book_construct, $book['buyer'], $book['seller'], $book['trans_date']);
            array_push($boughtBooks, $trans);
        }
        return $boughtBooks; 
    }

    public function soldBooks(){
        DataBase::init();
        $boughtBooks = array();
        $query = "SELECT * FROM transaction_history WHERE seller = '".parent::getUser()."' ORDER BY trans_date DESC";
        $result = DataBase::make_query($query);
        $bookbuilder = new BookBuilder();

        while ($book = mysqli_fetch_assoc($result)){
            $book_construct = $bookbuilder->createBookFromTransaction($book);
            $trans = new BookTransaction($book_construct, $book['buyer'], $book['seller'], $book['trans_date']);
            array_push($boughtBooks, $trans);
        }
        return $boughtBooks; 

    }
    public function numSoldBooks(){
        DataBase::init();
        $query = "SELECT price FROM transaction_history WHERE seller = '".parent::getUser()."'";
        $result = DataBase::make_query($query);
        return mysqli_num_rows($result);
    }
    public function numBoughtBooks(){
        DataBase::init();
        $query = "SELECT price FROM transaction_history WHERE buyer= '".parent::getUser()."'";
        $result = DataBase::make_query($query);
        return mysqli_num_rows($result);
    }
    public function profit(){
        DataBase::init();
        $price = 0;
        $query = "SELECT price FROM transaction_history WHERE seller= '".parent::getUser()."'";
        $result = DataBase::make_query($query);
        while($row = mysqli_fetch_assoc($result)){
            $price += $row['price'];
        }
        return $price;
    }
    public function spent(){
        DataBase::init();
        $price = 0;
        $query = "SELECT price FROM transaction_history WHERE buyer= '".parent::getUser()."'";
        $result = DataBase::make_query($query);
        while($row = mysqli_fetch_assoc($result)){
            $price += $row['price'];
        }
        return $price;
    }
    public function findBookHistory($id){
        DataBase::init();
        $query = "SELECT * FROM transaction_history WHERE id = $id";
        $result = DataBase::make_query($query);
        $builder = new BookBuilder();
        return $builder->createBookFromTransaction(mysqli_fetch_assoc($result));    
    }
    private function transactionQuery($str){
        DataBase::init();
        $boughtBooks = array();
        $query = "SELECT * FROM transaction_history WHERE ".$str."= '".parent::getUser()."' ORDER BY trans_date DESC";
        $result = DataBase::make_query($query);
        $bookbuilder = new BookBuilder();
        while ($book = mysqli_fetch_assoc($result)){
            $book_construct = $bookbuilder->createBookFromTransaction($book);
            $trans = new BookTransaction($book_construct, $book['buyer'], $book['seller'], $book['trans_date']);
            array_push($boughtBooks, $trans);
        }
        return $boughtBooks;
    }
}
?>
