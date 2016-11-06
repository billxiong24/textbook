<?php
include 'functions.php';

if(isset($_POST['listingID'])){
    removeListing($_POST['listingID']);
}
echo '';

?>