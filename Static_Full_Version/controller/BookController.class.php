<?php
require_once ("TransactionManager.class.php");
require_once('ProductManager.class.php');
require_once("UserManager.class.php");
require_once("NotificationManager.class.php");
require_once("BookBuilder.class.php");
class BookController{

    const DEFAULT_URL = 'http://www.clipartkid.com/images/815/blank-book-cover-clip-art-book-covers-szPmIv-clipart.png'; 
    private $trans_manager;
    private $product_manager; 
    private $notif_manager;
    private $user;
    public function __construct($user){
        $this->trans_manager = new TransactionManager($user);
        $this->product_manager = new ProductManager($user);
        $this->notif_manager = new NotificationManager($user);
        $this->user = $user;
    }
    public function addBook(){
        $this->checkEmptyParams();
        $course = explode(' - ', $_POST['course']);
        $course_name = count($course) > 1 ? $course[1] : '';
        $course_number = count($course) > 1 ? $course[0] : '';
        $price = floatval($_POST['price']);

        $bookbuilder = new BookBuilder();
        $bookbuilder->isbn($_POST['isbn'])->title($_POST['title'])->publishDate(strtotime($_POST['publishDate']));
        $bookbuilder->authors($_POST['authors'])->coverURL($_POST['coverURL'])->courseNum($course_number)->courseName($course_name);
        $bookbuilder->condition($_POST['bookCondition'])->notes($_POST['notes'])->price($price);
        $this->trans_manager->addBook($bookbuilder->createBook());
        $this->notif_manager->addNotification($this->user,'Added listing',$_POST['title'],$price); 
        //sendListEmail($isbn, $title, $publish_date, $authors, $course1, $book_condition, $notes, $price);
    }
    public function getCurrentListings(){
        return $this->product_manager->getCurrentListings();
    }
    public function getSoldBooks(){
        return $this->product_manager->soldBooks();
    }
    public function getBoughtBooks(){
        return $this->product_manager->boughtBooks();
    }
    public function buyBook($book_id){
        $book = $this->product_manager->getBook($book_id);
        $this->trans_manager->buyBook($book, $book_id);
        $bookInfo = $this->product_manager->findBookHistory($book_id);
        $title = $book->getTitle();
        $price = $book->getPrice();
        $this->notif_manager->addNotification($this->user,'Bought',$title,$price);
        $this->notif_manager->addNotification($book->getUsername(),'Someone bought',$title,$price);
        //sendBoughtEmail($book);
        //sendSoldEmail($book);
        return $bookInfo->getUsername();
    }
    public function cancelPurchase($purchase_id){
        $transaction = $this->product_manager->findBookHistory($purchase_id);
        $this->notif_manager->addNotification($transaction->getUsername(),'Canceled purchase',$transaction->getTitle(),$transaction->getPrice());
        $this->notif_manager->addNotification($this->user, 'Canceled purchase',$transaction->getTitle(),$transaction->getPrice());
        $this->trans_manager->cancelPurchase($transaction, $purchase_id);   
    }
    public function getBookDetails($bookID){
        $book = $this->product_manager->getBook($bookID);
        $usermanager = new UserManager($book->getUsername());
        $user = $usermanager->getUserInfo();
        $info = array();
        $info['seller'] = $user['name'];
        $info['email'] = $user['email'];
        $info['phone_num'] = $user['phone_num'];
        $info['pic'] = $book->getCoverURL();
        $info['price'] = $book->getPrice();
        $info['title'] = $book->getTitle();
        $info['isbn'] = $book->getIsbn(); 
        $info['authors'] = $book->getAuthors();
        $info['course_num'] = $book->getCourseNum();
        $info['book_condition'] = $book->getCondition();
        $info['publish_date'] = date('Y',$book->getPublishDate());
        $info['notes'] = $book->getNotes();
        return $info;
    }
    public function removeListing($listing_id){
        $this->trans_manager->removeListing($listing_id);
    }
    private function checkEmptyParams(){
        if (empty($_POST['isbn'])){
            $_POST['isbn'] = '';
        }
        if (empty($_POST['publishDate'])){
            $_POST['publishDate'] = -2147483645;
        }
        if (empty($_POST['coverURL'])){
            $_POST['coverURL'] = 'http://www.clipartkid.com/images/815/blank-book-cover-clip-art-book-covers-szPmIv-clipart.png';
        }
    }
} 
?>
