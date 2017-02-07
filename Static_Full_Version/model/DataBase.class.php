<?php
//FOLLOWS SINGLETON DESIGN PATTERN, so that there is only 1 instance of database;
class DataBase{
    private static $instance;
    private $database;
    private function __construct(){
        $this->database = mysqli_connect('localhost', 'root', 'Chem1313#', 'textbook_exchange');
        if(!$this->database){
            echo mysqli_errno($this->database);
        }
    }   

    public static function init(){
        if(!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;     
    }
    public static function get_database(){
        return self::$instance->database;
    }
    public static function make_query($query){
        $database = self::$instance->database; 
        $result = mysqli_query($database, $query);
        if(!$result){
            die("Query failed" . mysqli_error($database)); 
        }
        return $result;
    }
    public static function escape($str){
        $database = self::$instance->database;
        return mysqli_real_escape_string($database, $str);
    
    }
}
?>
