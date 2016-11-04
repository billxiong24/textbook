<?php
function sendSellEmail($isbn, $title, $publish_date, $authors, $course, $book_condition, $notes, $price){

	if(isset($_POST['title']) && isset($_SESSION['username'])){
		$user= getUser($_SESSION['username']);
		$to = $user['email'];
		$subject = "Added " . $title . " to the marketplace";
		$message = "Congratulations! You have posted \"" . $title . "\" for $" . $price . " to the marketplace. We will notify you when your item has been bought, so you can deliver it to the buyer.\n\n";
		$message .= "Details: \nTitle: " . $title . "\nPrice: " . $price . "\nCourse: " . $course . "\nBook Condition: " . $book_condition . "\nNotes: " . $notes;
		$headers .= 'Return-Path: billx0477@gmail.com' ."\r\n";
		$headers .= 'From: Duke Exchange' . "\r\n";
		mail($to, $subject, $message, $headers, "-femail.address@example.com");
	}
	else{
		header('Location: /textbook/Static_Full_Version/index.php');
	}
}
function sendBoughtEmail($isbn, $title, $publish_date, $authors, $course, $book_condition, $notes, $price){

}
?>