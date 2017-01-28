<?php
interface ITransaction{
    function buyBook($book, $book_id);
    function cancelPurchase($purchase_id);
    function boughtBooks();
    function soldBooks();
    function findBookHistory($id);
}
?>
