<?php
/**
 * interface for builder pattern object
 */
interface Builder{
    /**
     * create object designated by builder
     */
    function create();

    /**
     * create object designated by builder from query
     */
    function createFromQuery($query);
}
?>
