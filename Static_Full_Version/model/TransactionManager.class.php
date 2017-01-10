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
        //$this->notif_manager->addNotification(parent::getUser(),'Added listing',$title_no_escape,$price); // title_no_escape is passed because the function addNotification escapes its inputs. Escaping twice adds an extra slash
    }

    public function buyBook($book, $book_id){
        $buyer = DataBase::escape(parent::getUser());
        $seller = DataBase::escape($book['username']);
        $trans_date = time();
        $isbn = DataBase::escape($book['isbn']);
        $title = DataBase::escape($book['title']);
        $publish_date = $book['publish_date'];
        $authors = DataBase::escape($book['authors']);
        $cover_url = $book['cover_url'];
        $course_name = DataBase::escape($book['course_name']);
        $course_num = DataBase::escape($book['course_num']);
        $book_condition = DataBase::escape($book['book_condition']);
        $notes = DataBase::escape($book['notes']);
        $price = $book['price'];
        
        $query = 'INSERT INTO transaction_history(id,buyer,seller,trans_date,isbn,title,publish_date,authors,cover_url,course_name,course_num,book_condition,notes,price) ';
        $query .= "VALUES($book_id,'$buyer','$seller',$trans_date,'$isbn','$title',$publish_date,'$authors','$cover_url','$course_name','$course_num','$book_condition','$notes',$price)";
        $result = DataBase::make_query($query);
        
        $this->removeListing($book_id);
        //$this->notif_manager->addNotification($buyer,'Bought',$title,$price);
        //$this->notif_manager->addNotification($seller,'Someone bought',$title,$price);
    }
    public function removeListing($book_id){
        DataBase::init();
        $query = "DELETE FROM books ";
        $query .= "WHERE id = $book_id ";
        DataBase::make_query($query);
    }
    private function getBook($id){
        DataBase::init();
        $id = intval($id);
        $query = "SELECT * FROM books WHERE id = $id";
        $book = DataBase::make_query($query);
        $book = mysqli_fetch_assoc($book);
        return $book;

    }
    
    public function cancelPurchase($transaction, $purchase_id){
        DataBase::init(); 
        //$this->notif_manager->addNotification($transaction['seller'],'Canceled purchase',$transaction['title'],$transaction['price']);
        //$this->notif_manager->addNotification(parent::getUser(),'Canceled purchase',$transaction['title'],$transaction['price']);
        $action = new TransactionManager($transaction['seller']);
        $action->addBook($transaction['isbn'],$transaction['title'],$transaction['publish_date'],$transaction['authors'],$transaction['cover_url'],$transaction['course_name'],$transaction['course_num'],$transaction['book_condition'],$transaction['notes'],$transaction['price']);
        
        $query = "DELETE FROM transaction_history ";
        $query .= "WHERE id = $purchase_id ";
        DataBase::make_query($query);
    }
}
?>
