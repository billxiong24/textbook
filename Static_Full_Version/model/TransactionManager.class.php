<?php
include_once 'DataBase.class.php';
include_once 'SuperManager.class.php';
include_once 'NotificationManager.class.php';
class TransactionManager extends SuperManager{
    
    private $notif_manager; 
    public function __construct($user){
        parent::__construct($user);
        $this->notif_manager = new NotificationManager($user);
    }
    public function addBook($isbn,$title,$publish_date,$authors,$cover_url,$course_name,$course_num,$book_condition,$notes,$price){
        DataBase::init(); 
        $title_no_escape = $title;
        $isbn =  DataBase::escape($isbn);
        $title =  DataBase::escape($title);
        $publish_date =  DataBase::escape($publish_date);
        $authors =  DataBase::escape($authors);
        $cover_url =  DataBase::escape($cover_url);
        $course_name =  DataBase::escape($course_name);
        $course_num =  DataBase::escape($course_num);
        $book_condition =  DataBase::escape($book_condition);
        $notes =  DataBase::escape($notes);
        
        
        $query = 'INSERT INTO books(username,isbn,title,publish_date,authors,cover_url,course_name,course_num,book_condition,notes,price) ';
        $query .= "VALUES('".parent::getUser()."','$isbn','$title',$publish_date,'$authors','$cover_url','$course_name','$course_num','$book_condition','$notes',$price)";
        DataBase::make_query($query);
        $this->notif_manager->addNotification(parent::getUser(),'Added listing',$title_no_escape,$price); // title_no_escape is passed because the function addNotification escapes its inputs. Escaping twice adds an extra slash
    }

    public function buyBook($book_id){
        $buyer = parent::getUser();
        $book = $this->getBook($book_id);
        
        $seller = $book['username'];
        $trans_date = time();
        $isbn = $book['isbn'];
        $title = $book['title'];
        $publish_date = $book['publish_date'];
        $authors = $book['authors'];
        $cover_url = $book['cover_url'];
        $course_name = $book['course_name'];
        $course_num = $book['course_num'];
        $book_condition = $book['book_condition'];
        $notes = $book['notes'];
        $price = $book['price'];
        
        $buyer =  DataBase::escape($buyer);
        $seller =  DataBase::escape($seller);
        $isbn =  DataBase::escape($isbn);
        $title =  DataBase::escape($title);
        $authors =  DataBase::escape($authors);
        //$course_url =  DataBase::escape($course_url);
        $course_name =  DataBase::escape($course_name);
        $course_num =  DataBase::escape($course_num);
        $notes =  DataBase::escape($notes);
        
        $query = 'INSERT INTO transaction_history(id,buyer,seller,trans_date,isbn,title,publish_date,authors,cover_url,course_name,course_num,book_condition,notes,price) ';
        $query .= "VALUES($book_id,'$buyer','$seller',$trans_date,'$isbn','$title',$publish_date,'$authors','$cover_url','$course_name','$course_num','$book_condition','$notes',$price)";
        $result = DataBase::make_query($query);
        
        $this->removeListing($book_id);
        $this->notif_manager->addNotification($buyer,'Bought',$title,$price);
        $this->notif_manager->addNotification($seller,'Someone bought',$title,$price);
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
        $this->notif_manager->addNotification($transaction['seller'],'Canceled purchase',$transaction['title'],$transaction['price']);
        $this->notif_manager->addNotification(parent::getUser(),'Canceled purchase',$transaction['title'],$transaction['price']);
        $action = new TransactionManager($transaction['seller']);
        $action->addBook($transaction['isbn'],$transaction['title'],$transaction['publish_date'],$transaction['authors'],$transaction['cover_url'],$transaction['course_name'],$transaction['course_num'],$transaction['book_condition'],$transaction['notes'],$transaction['price']);
        
        $query = "DELETE FROM transaction_history ";
        $query .= "WHERE id = $purchase_id ";
        DataBase::make_query($query);
    }
}
?>
