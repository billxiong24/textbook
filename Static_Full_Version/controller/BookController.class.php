<?php
require_once ("TransactionManager.class.php");
require_once('ProductManager.class.php');
require_once("UserManager.class.php");
require_once("NotificationManager.class.php");
require_once("BookBuilder.class.php");
require_once("NotificationBuilder.class.php");
class BookController{

    const DEFAULT_URL = 'http://www.clipartkid.com/images/815/blank-book-cover-clip-art-book-covers-szPmIv-clipart.png'; 
    private $trans_manager;
    private $product_manager; 
    private $notif_manager;
    private $user;
    public function __construct($user, $trans, $prod, $notif){
        $this->trans_manager = $trans;
        $this->product_manager = $prod;
        $this->notif_manager = $notif;
        $this->user = $user;
    }
    public function addBook($product){
        $this->product_manager->addBook($product);
        $notif_builder = new NotificationBuilder();
        $notif_builder->username($this->user)->action('Added listing')->title($product->getTitle())->price($product->getPrice())->timestamp(time());
        $this->notif_manager->addNotification($notif_builder->create()); 
        //sendListEmail($isbn, $title, $publish_date, $authors, $course1, $book_condition, $notes, $price);
    }
    public function getCurrentListings(){
        return $this->product_manager->getCurrentListings();
    }
    public function getSoldBooks(){
        return $this->trans_manager->soldBooks();
    }
    public function getBoughtBooks(){
        return $this->trans_manager->boughtBooks();
    }
    public function buyBook($book_id){
        $book = $this->product_manager->getBook($book_id);
        $this->trans_manager->buyBook($book, $book_id);
        $this->product_manager->removeListing($book_id);
        $bookInfo = $this->trans_manager->findBookHistory($book_id);

        $title = $book->getTitle();
        $price = $book->getPrice();

        $notif_builder = new NotificationBuilder();
        $notif_builder->username($this->user)->action('Bought')->title($title)->price($price)->timestamp(time());
        $this->notif_manager->addNotification($notif_builder->create());
        $notif_builder->username($book->getUsername())->action('Someone Bought')->title($title)->price($price)->timestamp(time());
        $this->notif_manager->addNotification($notif_builder->create());
        //sendBoughtEmail($book);
        //sendSoldEmail($book);
        return $bookInfo->getUsername();
    }
    public function cancelPurchase($purchase_id){
        $transaction = $this->trans_manager->findBookHistory($purchase_id);

        $notif_builder = new NotificationBuilder();
        $notif_builder->username($transaction->getUsername())->action('Canceled purchase')->title($transaction->getTitle())->price($transaction->getPrice())->timestamp(time());

        $this->notif_manager->addNotification($notif_builder->create());
        $notif_builder->username($this->user)->action('Canceled purchase')->title($transaction->getTitle())->price($transaction->getPrice())->timestamp(time());
        $this->notif_manager->addNotification($notif_builder->create());
        $this->product_manager->addBook($transaction);
        $this->trans_manager->cancelPurchase($purchase_id);   
    }
    public function getBookDetails($bookID){
        $book = $this->product_manager->getBook($bookID);
        $usermanager = new UserManager($book->getUsername());
        $user = $usermanager->getUserInfo();
        $info = array();
        $info['seller'] = $user->getName();
        $info['email'] = $user->getEmail();
        $info['phone_num'] = $user->getPhone();
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
        $this->product_manager->removeListing($listing_id);
    }
} 
?>
