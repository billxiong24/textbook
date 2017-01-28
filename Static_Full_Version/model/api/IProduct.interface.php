<?php
interface IProduct{
    function addBook($book);
    function removeListing($book_id);
    function getCurrentListings();
    function getBook($id);
}
?>
