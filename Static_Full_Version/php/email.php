<?php
require '../../PHPMailer/PHPMailerAutoload.php';
include 'functions.php';
session_start();

$mail = new PHPMailer;

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'dukeexchange@gmail.com';                 // SMTP username
$mail->Password = 'duke2016!';                           // SMTP password
$mail->SMTPSecure = 'tls';                               // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('dukeexchange@gmail.com', 'Duke Book Exchange');
$mail->addReplyTo('dukeexchange@gmail.com', 'Duke Book Exchange');
$mail->isHTML(true);                                  // Set email format to HTML

function sendFeedbackEmail($subject, $feedback){
    global $mail;
    if (isset($_SESSION['username'])){
        $user = getUser($_SESSION['username']);
        $mail->addAddress('dukeexchange@gmail.com', $user['name']);     // Add a recipient
        $mail->Subject = $subject;
        $mail->Body = $feedback; 
        $mail->AltBody = $feedback; // for non-html emails
        $mail->send();
        
    }
    
}

function sendListEmail($isbn, $title, $publish_date, $authors, $course, $book_condition, $notes, $price){
	if(isset($_POST['title']) && isset($_SESSION['username'])){
		$user= getUser($_SESSION['username']);
        
        global $mail;
        $mail->addAddress($user['email'], $user['name']);     // Add a recipient
        $mail->Subject = "Added \"" . $title . "\" to the exchange";
        $mail->Body    =   '<table class="body-wrap" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;background-color: #f6f6f6;width: 100%;">
    <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
        <td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;"></td>
        <td class="container" width="600" style="margin: 0 auto !important;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;display: block !important;max-width: 600px !important;clear: both !important;">
            <div class="content" style="margin: 0 auto;padding: 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;max-width: 600px;display: block;">
                <table class="main" width="100%" cellpadding="0" cellspacing="0" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;background: #fff;border: 1px solid #e9e9e9;border-radius: 3px;">
                    <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                        <td class="content-wrap aligncenter" style="margin: 0;padding: 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;text-align: center;">
                            <table width="100%" cellpadding="0" cellspacing="0" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                    <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                        <h2 style="margin: 40px 0 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;Lucida Grande&quot;, sans-serif;box-sizing: border-box;font-size: 24px;color: #000;line-height: 1.2;font-weight: 400;">'."You have posted \"" . $title . "\" to the exchange. We will notify you when your item has been bought, so you can contact the buyer.".'</h2>
                                    </td>
                                </tr>
                                <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                    <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                        <table class="invoice" style="margin: 40px auto;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;text-align: left;width: 80%;">
                                            <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                <td style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">'.$user['name'].'
                                                    <br style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">'.date("F j, Y").'</td>
                                            </tr>
                                            <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                <td style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                                    <table class="invoice-items" cellpadding="0" cellspacing="0" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;width: 100%;">
                                                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                            <td style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;border-top: #eee 1px solid;">Title</td>
                                                            <td class="alignright" style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;text-align: right;border-top: #eee 1px solid;">'.$title.'</td>
                                                        </tr>
                                                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                            <td style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;border-top: #eee 1px solid;">ISBN</td>
                                                            <td class="alignright" style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;text-align: right;border-top: #eee 1px solid;">'.$isbn.'</td>
                                                        </tr>
                                                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                            <td style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;border-top: #eee 1px solid;">Price</td>
                                                            <td class="alignright" style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;text-align: right;border-top: #eee 1px solid;">$'.$price.'.00</td>
                                                        </tr>
                                                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                            <td style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;border-top: #eee 1px solid;">Course</td>
                                                            <td class="alignright" style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;text-align: right;border-top: #eee 1px solid;">'.$course.'</td>
                                                        </tr>
                                                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                            <td style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;border-top: #eee 1px solid;">Book Condition</td>
                                                            <td class="alignright" style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;text-align: right;border-top: #eee 1px solid;">'.$book_condition.'</td>
                                                        </tr>
                                                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                            <td style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;border-top: #eee 1px solid;">Notes</td>
                                                            <td class="alignright" style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;text-align: right;border-top: #eee 1px solid;">'.$notes.'</td>
                                                        </tr>


                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                    <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                        <a href="http://dukebookexchange.com/static_full_version/myAccount.php#listings" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;color: #092460;text-decoration: underline;">View in Duke Book Exchange</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <div class="footer" style="margin: 0;padding: 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;width: 100%;clear: both;color: #999;">
                    <table width="100%" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                            <td class="aligncenter content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;vertical-align: top;text-align: center;">Questions? Email <a href="mailto:dukeexchange@gmail.com" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;color: #999;text-decoration: underline;">dukeexchange@gmail.com</a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </td>
        <td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;"></td>
    </tr>
</table>
';
        
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();
        
	}
}

function sendBoughtEmail($book){
	if(isset($_POST['bookID']) && isset($_SESSION['username'])){
        $buyer = getUser($book['buyer']);
		$seller = getUser($book['seller']);
	    $isbn = $book['isbn'];
	    $title = $book['title'];
	    $authors = $book['authors'];
        if (strlen($book['course_num'])>0){
	       $course = $book['course_num'] . ' - ' . $book['course_name'];
        }
        else {
            $course = '';
        }
	    $book_condition = $book['book_condition'];
	    $notes = $book['notes'];
	    $price = $book['price'];
        
        global $mail;
        $mail->addAddress($buyer['email'], $buyer['name']);     // Add a recipient
        $mail->Subject = "You bought \"" . $title . "\"";
        $mail->Body    =   '<table class="body-wrap" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;background-color: #f6f6f6;width: 100%;">
    <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
        <td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;"></td>
        <td class="container" width="600" style="margin: 0 auto !important;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;display: block !important;max-width: 600px !important;clear: both !important;">
            <div class="content" style="margin: 0 auto;padding: 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;max-width: 600px;display: block;">
                <table class="main" width="100%" cellpadding="0" cellspacing="0" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;background: #fff;border: 1px solid #e9e9e9;border-radius: 3px;">
                    <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                        <td class="content-wrap aligncenter" style="margin: 0;padding: 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;text-align: center;">
                            <table width="100%" cellpadding="0" cellspacing="0" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                    <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                        <h2 style="margin: 40px 0 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;Lucida Grande&quot;, sans-serif;box-sizing: border-box;font-size: 24px;color: #000;line-height: 1.2;font-weight: 400;">'."Congratulations! You bought \"" . $title . ".\" Contact the seller below.".'</h2>
                                    </td>
                                </tr>
                                <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                    <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                        <table class="invoice" style="margin: 40px auto;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;text-align: left;width: 80%;">
                                            <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                <td style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">'.$buyer['name'].'
                                                    <br style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">'.date("F j, Y").'</td>
                                            </tr>
                                            <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                <td style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                                    <table class="invoice-items" cellpadding="0" cellspacing="0" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;width: 100%;">
                                                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                            <td style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;border-top: #eee 1px solid;">Title</td>
                                                            <td class="alignright" style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;text-align: right;border-top: #eee 1px solid;">'.$title.'</td>
                                                        </tr>
                                                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                            <td style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;border-top: #eee 1px solid;">ISBN</td>
                                                            <td class="alignright" style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;text-align: right;border-top: #eee 1px solid;">'.$isbn.'</td>
                                                        </tr>
                                                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                            <td style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;border-top: #eee 1px solid;">Price</td>
                                                            <td class="alignright" style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;text-align: right;border-top: #eee 1px solid;">$'.$price.'.00</td>
                                                        </tr>
                                                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                            <td style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;border-top: #eee 1px solid;">Course</td>
                                                            <td class="alignright" style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;text-align: right;border-top: #eee 1px solid;">'.$course.'</td>
                                                        </tr>
                                                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                            <td style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;border-top: #eee 1px solid;">Book Condition</td>
                                                            <td class="alignright" style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;text-align: right;border-top: #eee 1px solid;">'.$book_condition.'</td>
                                                        </tr>
                                                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                            <td style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;border-top: #eee 1px solid;">Notes</td>
                                                            <td class="alignright" style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;text-align: right;border-top: #eee 1px solid;">'.$notes.'</td>
                                                        </tr>
                                                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                            <td style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;border-top: #eee 1px solid;">Seller Name</td>
                                                            <td class="alignright" style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;text-align: right;border-top: #eee 1px solid;">'.$seller['name'].'</td>
                                                        </tr>
                                                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                            <td style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;border-top: #eee 1px solid;">Seller Phone Number</td>
                                                            <td class="alignright" style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;text-align: right;border-top: #eee 1px solid;">'.$seller['phone_num'].'</td>
                                                        </tr>
                                                         <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                            <td style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;border-top: #eee 1px solid;">Seller Email</td>
                                                            <td class="alignright" style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;text-align: right;border-top: #eee 1px solid;">'."<a href=\"mailto:{$seller['email']}\">{$seller['email']}</a>".'</td>
                                                        </tr>


                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                    <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                        <a href="http://dukebookexchange.com/static_full_version/myAccount.php#purchase-history" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;color: #092460;text-decoration: underline;">View in Duke Book Exchange</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <div class="footer" style="margin: 0;padding: 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;width: 100%;clear: both;color: #999;">
                    <table width="100%" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                            <td class="aligncenter content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;vertical-align: top;text-align: center;">Questions? Email <a href="mailto:dukeexchange@gmail.com" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;color: #999;text-decoration: underline;">dukeexchange@gmail.com</a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </td>
        <td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;"></td>
    </tr>
</table>
';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();


	}
} 

function sendSoldEmail($book){
	if(isset($_POST['bookID']) && isset($_SESSION['username'])){
        $buyer = getUser($book['buyer']);
		$seller = getUser($book['seller']);
	    $isbn = $book['isbn'];
	    $title = $book['title'];
	    $authors = $book['authors'];   
        if (strlen($book['course_num'])>0){
	       $course = $book['course_num'] . ' - ' . $book['course_name'];
        }
        else {
            $course = '';
        }
	    $book_condition = $book['book_condition'];
	    $notes = $book['notes'];
	    $price = $book['price'];
        
        global $mail;
        $mail->addAddress($seller['email'], $seller['name']);     // Add a recipient
        $mail->Subject = "You sold \"" . $title . "\"";
        $mail->Body    =   '<table class="body-wrap" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;background-color: #f6f6f6;width: 100%;">
    <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
        <td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;"></td>
        <td class="container" width="600" style="margin: 0 auto !important;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;display: block !important;max-width: 600px !important;clear: both !important;">
            <div class="content" style="margin: 0 auto;padding: 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;max-width: 600px;display: block;">
                <table class="main" width="100%" cellpadding="0" cellspacing="0" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;background: #fff;border: 1px solid #e9e9e9;border-radius: 3px;">
                    <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                        <td class="content-wrap aligncenter" style="margin: 0;padding: 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;text-align: center;">
                            <table width="100%" cellpadding="0" cellspacing="0" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                    <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                        <h2 style="margin: 40px 0 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;Lucida Grande&quot;, sans-serif;box-sizing: border-box;font-size: 24px;color: #000;line-height: 1.2;font-weight: 400;">'."Congratulations! You sold \"" . $title . ".\" Contact the buyer below.".'</h2>
                                    </td>
                                </tr>
                                <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                    <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                        <table class="invoice" style="margin: 40px auto;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;text-align: left;width: 80%;">
                                            <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                <td style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">'.$buyer['name'].'
                                                    <br style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">'.date("F j, Y").'</td>
                                            </tr>
                                            <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                <td style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                                    <table class="invoice-items" cellpadding="0" cellspacing="0" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;width: 100%;">
                                                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                            <td style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;border-top: #eee 1px solid;">Title</td>
                                                            <td class="alignright" style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;text-align: right;border-top: #eee 1px solid;">'.$title.'</td>
                                                        </tr>
                                                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                            <td style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;border-top: #eee 1px solid;">ISBN</td>
                                                            <td class="alignright" style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;text-align: right;border-top: #eee 1px solid;">'.$isbn.'</td>
                                                        </tr>
                                                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                            <td style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;border-top: #eee 1px solid;">Price</td>
                                                            <td class="alignright" style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;text-align: right;border-top: #eee 1px solid;">$'.$price.'.00</td>
                                                        </tr>
                                                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                            <td style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;border-top: #eee 1px solid;">Course</td>
                                                            <td class="alignright" style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;text-align: right;border-top: #eee 1px solid;">'.$course.'</td>
                                                        </tr>
                                                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                            <td style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;border-top: #eee 1px solid;">Book Condition</td>
                                                            <td class="alignright" style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;text-align: right;border-top: #eee 1px solid;">'.$book_condition.'</td>
                                                        </tr>
                                                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                            <td style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;border-top: #eee 1px solid;">Notes</td>
                                                            <td class="alignright" style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;text-align: right;border-top: #eee 1px solid;">'.$notes.'</td>
                                                        </tr>
                                                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                            <td style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;border-top: #eee 1px solid;">Buyer Name</td>
                                                            <td class="alignright" style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;text-align: right;border-top: #eee 1px solid;">'.$buyer['name'].'</td>
                                                        </tr>
                                                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                            <td style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;border-top: #eee 1px solid;">Buyer Phone Number</td>
                                                            <td class="alignright" style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;text-align: right;border-top: #eee 1px solid;">'.$buyer['phone_num'].'</td>
                                                        </tr>
                                                         <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                            <td style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;border-top: #eee 1px solid;">Buyer Email</td>
                                                            <td class="alignright" style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;text-align: right;border-top: #eee 1px solid;">'."<a href=\"mailto:{$buyer['email']}\">{$buyer['email']}</a>".'</td>
                                                        </tr>


                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                    <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                        <a href="http://dukebookexchange.com/static_full_version/myAccount.php#sold" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;color: #092460;text-decoration: underline;">View in Duke Book Exchange</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <div class="footer" style="margin: 0;padding: 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;width: 100%;clear: both;color: #999;">
                    <table width="100%" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                            <td class="aligncenter content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;vertical-align: top;text-align: center;">Questions? Email <a href="mailto:dukeexchange@gmail.com" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;color: #999;text-decoration: underline;">dukeexchange@gmail.com</a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </td>
        <td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;"></td>
    </tr>
</table>
';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();
	}
}

?>