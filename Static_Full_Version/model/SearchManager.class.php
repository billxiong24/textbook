<?php
require_once("SuperManager.class.php");
require_once("DataBase.class.php");
class SearchManager extends SuperManager{
    //TODO implement filter pattern here 
    
    public function __construct($user){
        parent::__construct($user);
    }
    public function search($search, $price, $condition){
        DataBase::init();
        $price_search = '';
        $condition_search = '';
        if ($price != 'Any'){
            $price_search = "AND price < $price";     
        }
        
        if($condition != 'Any'){ //
            $condition_search = "AND book_condition = '$condition'";
        }
        
        $search = strtolower($search);
        $search = DataBase::escape($search);
        if($search == 'all' || $search == ''){
           $query = $this->decideQuery($price, $condition);
        }
        else{
            $query = "SELECT * FROM books WHERE MATCH(isbn,title,authors,course_name,course_num) AGAINST('$search') $price_search $condition_search";
        }
        return DataBase::make_query($query);
    }
    private function decideQuery($price, $condition){
        if ($price != 'Any' && $condition != 'Any'){
            return "SELECT * FROM books WHERE price < $price AND book_condition = '$condition'";     
        }
        else if ($price != 'Any'){
            return "SELECT * FROM books WHERE price < $price";
        }
        else if ($condition != 'Any'){
            return "SELECT * FROM books WHERE book_condition = '$condition'";
        }

        else {
            return "SELECT * FROM books";
        }
    }
}
?>
