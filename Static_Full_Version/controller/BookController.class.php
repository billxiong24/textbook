<?php
require_once ("TransactionManager.class.php");
require_once('ProductManager.class.php');
require_once("UserManager.class.php");
require_once("NotificationManager.class.php");
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
        $username = $this->user;
        $isbn = $_POST['isbn'];
        $title = $_POST['title'];
        $publish_date = strtotime($_POST['publishDate']);
        $authors = $_POST['authors'];
        $cover_url = $_POST['coverURL'];
        $course1 = $_POST['course'];
        $course = explode(' - ', $course1);
        if (count($course)!=0){
           $course_number = $course[0];
           $course_name = $course[1]; 
        }
        $book_condition = $_POST['bookCondition'];
        $notes = $_POST['notes'];
        $price = floatval($_POST['price']);
        $this->trans_manager->addBook($isbn,$title,$publish_date,$authors,$cover_url,$course_name,$course_number,$book_condition,$notes,$price);
        $this->notif_manager->addNotification($this->user,'Added listing',$title,$price); // title_no_escape is passed because the function addNotification escapes its inputs. Escaping twice adds an extra slash
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
        $title = $book['title'];
        $price = $book['price'];
        $this->notif_manager->addNotification($this->user,'Bought',$title,$price);
        $this->notif_manager->addNotification($book['username'],'Someone bought',$title,$price);
        //sendBoughtEmail($book);
        //sendSoldEmail($book);
        return $bookInfo;
    }
    public function cancelPurchase($purchase_id){
        $transaction = $this->product_manager->findBookHistory($purchase_id);
        $this->notif_manager->addNotification($transaction['seller'],'Canceled purchase',$transaction['title'],$transaction['price']);
        $this->notif_manager->addNotification($this->user, 'Canceled purchase',$transaction['title'],$transaction['price']);
        $this->trans_manager->cancelPurchase($transaction, $purchase_id);   
    }
    public function getBookDetails($bookID){
        $book = $this->product_manager->getBook($bookID);
        $usermanager = new UserManager($book['username']);
        $user = $usermanager->getUserInfo();
        $info = array();
        $info['seller'] = $user['name'];
        $info['email'] = $user['email'];
        $info['phone_num'] = $user['phone_num'];
        $info['pic'] = $book['cover_url'];
        $info['price'] = $book['price'];
        $info['title'] = $book['title'];
        $info['isbn'] = $book['isbn']; 
        $info['authors'] = $book['authors'];
        $info['course_num'] = $book['course_num'];
        $info['book_condition'] = $book['book_condition'];
        $info['publish_date'] = date('Y',$book['publish_date']);
        $info['notes'] = $book['notes'];
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
