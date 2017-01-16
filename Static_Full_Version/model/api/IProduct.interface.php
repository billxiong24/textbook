<?php
interface IProduct{
    function getCurrentListings();
    function getBook(int $id);
    function boughtBooks();
    function soldBooks();
    function numSoldBooks();
    function numBoughtBooks();
    function profit();
    function spent();
    function findBookHistory();
}
?>
