<?php
	$old = getcwd();
	chdir('../scripts');
	$subject = "\"Sold: Fundamentals of Physics\"";
	$message = "\"You have sold this book.\"";
	$output = shell_exec('echo bill1313 | sudo -S ./send-mail.sh billx0477@gmail.com bill1313 wwx@duke.edu ' . $subject. " " . $message);
	echo $output;
	chdir($old);
?>
