<?php
include "email.php";
include "functions.php";
session_start();
if (isset($_POST['title']) && isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    $isbn = $_POST['isbn'];
    $title = $_POST['title'];
    $publish_date = strtotime($_POST['publishDate']);
    $authors = $_POST['authors'];
    $cover_url = $_POST['coverURL'];
    $course1 = $_POST['course'];
    $course = explode(' - ', $course1);
    $course_number = $course[0];
    $course_name = $course[1];
    $book_condition = $_POST['bookCondition'];
    $notes = $_POST['notes'];
    $price = floatval($_POST['price']);
    addBook($username,$isbn,$title,$publish_date,$authors,$cover_url,$course_name,$course_number,$book_condition,$notes,$price);
    sendListEmail($isbn, $title, $publish_date, $authors, $course1, $book_condition, $notes, $price);
}
echo '';
?>