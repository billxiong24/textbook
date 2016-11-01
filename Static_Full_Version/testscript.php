<?php
	$old = getcwd();
	chdir('/home/billxiong24/JavaFiles');
	$subject = "\"Sold: Fundamentals of Physics\"";
	$message = "\"You have sold this book.\"";
	$output = exec('echo bill1313 | sudo -S java -cp "../lib/*:." SendEmailAuto billx0477@gmail.com bill1313 wwx@duke.edu ' . $subject. " " . $message);
	echo $output;
	echo "helloworld";
	chdir($old);
?>
