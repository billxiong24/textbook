<?php
interface ISearch{
    function search($search, $price, $condition);
    function filter($price, $condition);
}
?>
