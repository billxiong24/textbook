<?php
//include "email.php";
//require_once("TransactionManager.class.php");
require_once("SessionLoader.class.php");
require_once("BookBuilder.class.php");
//include '../model/TransactionManager.class.php';
//include '../controller/BookController.class.php';
//include "functions.php"; both included in email.php
session_start();
if (isset($_POST['title']) && isset($_SESSION['username'])){
    checkEmptyParams();
    $course = explode(' - ', $_POST['course']);
    $course_name = count($course) > 1 ? $course[1] : '';
    $course_number = count($course) > 1 ? $course[0] : '';
    $price = floatval($_POST['price']);

    $bookbuilder = new BookBuilder();
    $bookbuilder->isbn($_POST['isbn'])->title($_POST['title'])->publishDate(strtotime($_POST['publishDate']));
    $bookbuilder->authors($_POST['authors'])->coverURL($_POST['coverURL'])->courseNum($course_number)->courseName($course_name);
    $bookbuilder->condition($_POST['bookCondition'])->notes($_POST['notes'])->price($price);
    $_SESSION['loader']->getBookController()->addBook($bookbuilder->create());
    //sendListEmail($isbn, $title, $publish_date, $authors, $course1, $book_condition, $notes, $price); 
}
echo '';
function checkEmptyParams(){
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
?>
