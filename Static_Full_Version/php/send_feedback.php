<?php
include 'email.php';
if (isset($_POST['subject']) && isset($_POST['feedback'])){
    
    sendFeedbackEmail($_POST['subject'],$_POST['feedback']);
    
}
echo '';
?>