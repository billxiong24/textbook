<?php
interface ITransaction{
    function addBook(Book $book);
    function buyBook(Book $book, int $book_id);
    function removeListing($int $book_id);
    function cancelPurchase(Book $book, int $book_id);
}
?>
