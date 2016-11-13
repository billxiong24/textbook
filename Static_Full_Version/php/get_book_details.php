<?php
include 'functions.php';
if(isset($_POST['bookID'])){  
    $bookID = $_POST['bookID'];
    $book = getBook($bookID);
    $user = getUser($book['username']);
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
    $info = json_encode($info);
    echo $info;
    
}




?>