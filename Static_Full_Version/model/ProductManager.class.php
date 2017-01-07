<?php
include_once 'DataBase.class.php';
include_once 'NotificationManager.class.php';
include_once 'SuperManager.class.php';
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
        $query = "SELECT * FROM books WHERE username = '".parent::getUser()."' ";
        $result = DataBase::make_query($query);
        while ($book = mysqli_fetch_assoc($result)){
            array_push($listings, $book);
        }
        return array_reverse($listings);  // first books are most recent
    }

    public function getBook($id){
        DataBase::init();
        $id = intval($id);
        $query = "SELECT * FROM books WHERE id = $id";
        $book = DataBase::make_query($query);
        $book = mysqli_fetch_assoc($book);
        return $book;
    }
    public function boughtBooks(){
        DataBase::init();
        $boughtBooks = array();
        $query = "SELECT * FROM transaction_history WHERE buyer = '".parent::getUser()."' ORDER BY trans_date DESC";
        $result = DataBase::make_query($query);
        while ($book = mysqli_fetch_assoc($result)){
            array_push($boughtBooks, $book);
        }
        return $boughtBooks; 
    }

    public function soldBooks(){
        DataBase::init();
        $boughtBooks = array();
        $query = "SELECT * FROM transaction_history WHERE seller = '".parent::getUser()."' ORDER BY trans_date DESC";
        $result = DataBase::make_query($query);
        while ($book = mysqli_fetch_assoc($result)){
            array_push($boughtBooks, $book);
        }
        return $boughtBooks; 
    }

    public function findBookHistory($id){
        DataBase::init();
        $query = "SELECT * FROM transaction_history WHERE id = $id";
        $result = DataBase::make_query($query);
        return mysqli_fetch_assoc($result);    
    }
}
?>
