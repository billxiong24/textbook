<?php
require_once("SearchManager.class.php");
require_once("SearchView.class.php");
require_once("BookBuilder.class.php");
require_once("Book.class.php");
class SearchController{
    private $user;
    private $search_manager;
    private $display;
    public function __construct($user){
        $this->user = $user;    
        $this->search_manager = new SearchManager($user);
        $this->display = new SearchView();
    }
    public function search($search, $price, $condition){
        $result = $this->search_manager->search($search, $price, $condition);
        $num_results = mysqli_num_rows($result);
        mysqli_data_seek($result, 0);
        $books_displayed = '';
        $bookbuilder = new BookBuilder();
        while($row = mysqli_fetch_assoc($result)){
            $book = $bookbuilder->createFromQuery($row);
            $books_displayed .= $this->display->displaySearch($book);
        }
        $books_displayed = $this->display->appendRowClass($books_displayed);
        return array("numResults"=>$num_results, "books"=>$books_displayed);
    }
}
?>
