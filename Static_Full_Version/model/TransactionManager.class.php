<?php
include_once 'DataBase.class.php';
include_once 'NotificationManager.class.php';
include_once 'SuperManager.class.php';
require_once("BookBuilder.class.php");
require_once("BookTransaction.class.php");
require_once("api/ITransaction.interface.php");
//include_once 'NotificationManager.class.php';
class TransactionManager extends SuperManager implements ITransaction{
    
    public function __construct($user){
        parent::__construct($user);
    }
    public function buyBook($book, $book_id){
        $isbn =  DataBase::escape($book->getIsbn());
        $title =  DataBase::escape($book->getTitle());
        $publish_date =  DataBase::escape($book->getPublishDate());
        $authors =  DataBase::escape($book->getAuthors());
        $cover_url =  DataBase::escape($book->getCoverURL());
        $course_name =  DataBase::escape($book->getCourseName());
        $course_num =  DataBase::escape($book->getCourseNum());
        $book_condition =  DataBase::escape($book->getCondition());
        $notes =  DataBase::escape($book->getNotes());
        $price = $book->getPrice();
        $trans_date = time();
        $buyer = DataBase::escape(parent::getUser());
        $seller = DataBase::escape($book->getUsername());
        $query = 'INSERT INTO transaction_history(id,buyer,seller,trans_date,isbn,title,publish_date,authors,cover_url,course_name,course_num,book_condition,notes,price) ';
        $query .= "VALUES($book_id,'$buyer','$seller',$trans_date,'$isbn','$title',$publish_date,'$authors','$cover_url','$course_name','$course_num','$book_condition','$notes',$price)";
        $result = DataBase::make_query($query);
    }
    
    public function cancelPurchase($purchase_id){
        DataBase::init(); 
        $query = "DELETE FROM transaction_history ";
        $query .= "WHERE id = $purchase_id ";
        DataBase::make_query($query);
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
