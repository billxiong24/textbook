<?php
include_once 'DataBase.class.php';
include_once 'SuperManager.class.php';
require_once("Book.class.php");
require_once("BookBuilder.class.php");

//include_once 'NotificationManager.class.php';
class TransactionManager extends SuperManager{
    
    public function __construct($user){
        parent::__construct($user);
    }
    public function addBook($book){
        DataBase::init(); 
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
        
        $query = 'INSERT INTO books(username,isbn,title,publish_date,authors,cover_url,course_name,course_num,book_condition,notes,price) ';
        $query .= "VALUES('".parent::getUser()."','$isbn','$title',$publish_date,'$authors','$cover_url','$course_name','$course_num','$book_condition','$notes',$price)";
        DataBase::make_query($query);
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
        $this->removeListing($book_id);
    }
    public function removeListing($book_id){
        DataBase::init();
        $query = "DELETE FROM books ";
        $query .= "WHERE id = $book_id ";
        DataBase::make_query($query);
    }
    
    public function cancelPurchase($transaction, $purchase_id){
        DataBase::init(); 
        $action = new TransactionManager($transaction->getUsername());
        $action->addBook($transaction);
        $query = "DELETE FROM transaction_history ";
        $query .= "WHERE id = $purchase_id ";
        DataBase::make_query($query);
    }
}
?>
