<?php
function sendListEmail($isbn, $title, $publish_date, $authors, $course, $book_condition, $notes, $price){
	if(isset($_POST['title']) && isset($_SESSION['username'])){
		$user= getUser($_SESSION['username']);
		$to = $user['email'];
		$subject = "Added \"" . $title . "\" to the marketplace";
		$message = "Congratulations! You have posted \"" . $title . "\" for $" . $price . " to the marketplace. We will notify you when your item has been bought, so you can deliver it to the buyer.\n\n";
		$message .= "Details: \nTitle: " . $title . "\nISBN: " . $isbn . "\nPrice: " . $price . "\nCourse: " . $course . "\nBook Condition: " . $book_condition . "\nNotes: " . $notes;
		$headers .= 'Return-Path: billx0477@gmail.com' ."\r\n";
		$headers .= 'From: Duke Exchange' . "\r\n";
		mail($to, $subject, $message, $headers, "-femail.address@example.com");
	}
	else{
		header('Location: /textbook/Static_Full_Version/index.php');
	}
}

function sendBoughtEmail($book, $trans_date){
	if(isset($_POST['bookID']) && isset($_SESSION['username'])){
		$seller = $book['username'];
	    $isbn = $book['isbn'];
	    $title = $book['title'];
	    $authors = $book['authors'];
	    $course_name = $book['course_name'];
	    $course_num = $book['course_num'];
	    $book_condition = $book['book_condition'];
	    $notes = $book['notes'];
	    $price = $book['price'];

		$buyer = getUser($_SESSION['username']);
		$to = $buyer['email'];
		$subject = "You bought \"" . $title . "\" from " .  $seller;
		$message = "Congratulations! You bought \"" . $title . "\" for $" . $price . " from " . $seller .  " on " . $trans_date .". Your item will be delivered shortly.\n\n";
		$message .= "Details: \nTitle: " . $title . "\nAuthors: " . $authors . "\nISBN: " . $isbn . "\nPrice: $" . $price . "\nCourse: " . $course_num . "\nBook Condition: " . $book_condition . "\nNotes: " . $notes;
		$headers .= 'Return-Path: billx0477@gmail.com' ."\r\n";
		$headers .= 'From: Duke Exchange' . "\r\n";
		mail($to, $subject, $message, $headers);
	}
} 

function sendSoldEmail($book, $trans_date){
	if(isset($_POST['bookID']) && isset($_SESSION['username'])){
		$seller = $book['username'];
	    $isbn = $book['isbn'];
	    $title = $book['title'];
	    $authors = $book['authors'];
	    $course_name = $book['course_name'];
	    $course_num = $book['course_num'];
	    $book_condition = $book['book_condition'];
	    $notes = $book['notes'];
	    $price = $book['price'];
	    $to = $seller['username'];
	    $buyer = getUser($_SESSION['username']);
	    $subject = "You sold \"" . $title;
		$message = "Congratulations! You sold \"" . $title . "\" for $" . $price . " to " . $seller .  " on " . $trans_date .". Your should contact the buyer to deliver your item.\n\n";
		$message .= "Details: \nTitle: " . $title . "\nAuthors: " . $authors . "\nISBN: " . $isbn . "\nPrice: $" . $price . "\nCourse: " . $course_num . "\nBook Condition: " . $book_condition . "\nNotes: " . $notes;
		$headers .= 'Return-Path: billx0477@gmail.com' ."\r\n";
		$headers .= 'From: Duke Exchange' . "\r\n";
	}
}

?>