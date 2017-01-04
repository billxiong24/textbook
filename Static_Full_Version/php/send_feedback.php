<?php
include 'email.php';
if (isset($_POST['subject']) && isset($_POST['feedback']) && isset($_SESSION['username'])){
    
    sendFeedbackEmail($_POST['subject'],$_POST['feedback']);
    
}
echo '';
?>