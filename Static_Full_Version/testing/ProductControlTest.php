<?php
require_once("../model/mocks/ProductMock.class.php");
require_once("../model/mocks/TransactionMock.class.php");
require_once("../model/mocks/NotificationMock.class.php");
require_once("BookController.class.php");
class ProductControlTest extends PHPUnit_Framework_TestCase{

    public function setUp(){
        parent::setUp();
    }

    public function tearDown(){
        parent::tearDown();
    }
    public function testAddProduct(){
        $user = "bill";
        $product_mock = new ProductMock($user);
        $trans_mock = new TransactionMock($user);
        $notif_mock = new NotificationMock($user);
        $bookController = new BookController($user, $trans_mock, $product_mock, $notif_mock);

        $book = $this->addProduct(); 
        $bookController->addBook($book);
        //assertions
        $this->checkAddedProduct($product_mock, $book);
        $this->assertEquals($this->checkNotifications($notif_mock, 'getNotifications'), 1);
        $this->assertEquals($user, $notif_mock->getNotifications()[0]->getUsername());
    }
    public function testCurrentListings(){
        $user = "bill";
        $product_mock = new ProductMock($user);
        $product_mock->addBook($this->addProduct());

        $trans_mock = new TransactionMock($user);
        $notif_mock = new NotificationMock($user);
        $controller = new BookController($user, $trans_mock, $product_mock, $notif_mock);
        $arr = $controller->getCurrentListings();
        $this->assertEquals(1, count($arr));
    }
    public function testSoldProducts(){
        $user = "bill";
        $product_mock = new ProductMock($user);
        $product_mock->addBook($this->addProduct());

        $trans_mock = new TransactionMock($user);
        $notif_mock = new NotificationMock($user);
        $controller = new BookController($user, $trans_mock, $product_mock, $notif_mock);
        $controller->buyBook(1);

        $result = $controller->getSoldBooks();
        $this->assertEquals(count($result), 1);
    }
    public function testBoughtProducts(){
        //lmao if you bought, you sold
        $this->testSoldProducts();
    }
    public function testCancelPurchase(){
        $user = "bill";
        $product_mock = new ProductMock($user);
        $product_mock->addBook($this->addProduct());

        $trans_mock = new TransactionMock($user);
        $notif_mock = new NotificationMock($user);
        $controller = new BookController($user, $trans_mock, $product_mock, $notif_mock);
        $controller->buyBook(1);
        $controller->cancelPurchase(1); 
        
        $this->assertNotNull($product_mock->getBook(1));
        $this->checkAddedProduct($product_mock, $product_mock->getBook(1));
        $this->assertNull($trans_mock->getTrans(1));
        $this->assertEquals(4, $this->checkNotifications($notif_mock, 'getAllNotifs'));
    }
    //TODO make this method testable 
    public function testGetProductDetails(){
        //this is just getters
        $user = "john";
        $product_mock = new ProductMock($user);
        $product_mock->addBook($this->addProduct());

        $trans_mock = new TransactionMock($user);
        $notif_mock = new NotificationMock($user);
        $controller = new BookController($user, $trans_mock, $product_mock, $notif_mock);
         
        $this->assertTrue(true);
        return $controller;
    }
    public function testBuyProduct(){
        //TODO check buyer is john
        $user = "john";
        $product_mock = new ProductMock($user);
        $product_mock->addBook($this->addProduct());

        $trans_mock = new TransactionMock($user);
        $notif_mock = new NotificationMock($user);
        $controller = new BookController($user, $trans_mock, $product_mock, $notif_mock);
        $result = $controller->buyBook(1);

        $this->assertEquals($result, "bill");
        $this->assertNull($product_mock->getBook(1));
        $this->assertEquals(2, $this->checkNotifications($notif_mock, 'getAllNotifs'));
        $this->assertNotNull($trans_mock->findBookHistory(1));
    } 
    /*private function createProductController($user){
        $product_mock = new ProductMock($user);
        $trans_mock = new TransactionMock($user);
        $notif_mock = new NotificationMock($user);
        return new BookController($user, $trans_mock, $product_mock, $notif_mock);
    }*/
    private function addProduct(){
        $bookbuilder = new BookBuilder();
        $bookbuilder->username("bill")->isbn(253)->title("book1")->publishDate("time1");
        $bookbuilder->authors("author1")->coverURL("url1")->courseNum("123")->courseName("math");
        $bookbuilder->condition("good")->notes("notes")->price("234")->id(1);
        return $bookbuilder->create();

    }
    private function checkAddedProduct($product_mock, $book){
        $this->assertArrayHasKey(1, $product_mock->getData());
        $this->assertEquals($product_mock->getBook($book->getID())->getUsername(), "bill");
        $this->assertEquals($product_mock->getBook($book->getID())->getIsbn(), 253);
        $this->assertEquals($product_mock->getBook($book->getID())->getTitle(), "book1");
        $this->assertEquals($product_mock->getBook($book->getID())->getPublishDate(), "time1");
        $this->assertEquals($product_mock->getBook($book->getID())->getAuthors(), "author1");
        $this->assertEquals($product_mock->getBook($book->getID())->getCoverURL(), "url1");
        $this->assertEquals($product_mock->getBook($book->getID())->getCourseNum(), "123");
        $this->assertEquals($product_mock->getBook($book->getID())->getCourseName(), "math");
        $this->assertEquals($product_mock->getBook($book->getID())->getCondition(), "good");
        $this->assertEquals($product_mock->getBook($book->getID())->getNotes(), "notes");
        $this->assertEquals($product_mock->getBook($book->getID())->getPrice(), "234");
    }
    private function checkNotifications($notification_mock, $func){
        return count(call_user_func(array($notification_mock, $func)));
    }
}
?>
