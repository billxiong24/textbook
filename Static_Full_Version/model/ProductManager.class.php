<?php
include_once 'DataBase.class.php';
include_once 'NotificationManager.class.php';
include_once 'SuperManager.class.php';
require_once("BookBuilder.class.php");
require_once("BookTransaction.class.php");
require_once("api/IProduct.interface.php");
/**
 * For now, this is manages books- extensible to other
 * produts as well
 */
class ProductManager extends SuperManager implements IProduct{

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
    public function removeListing($book_id){
        DataBase::init();
        $query = "DELETE FROM books ";
        $query .= "WHERE id = $book_id ";
        DataBase::make_query($query);
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
}
?>
