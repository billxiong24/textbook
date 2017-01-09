<?php
require_once("Book.class.php");
class SearchView{
    public function appendRowClass($str){
        return '<div class = "row">' . $str . '</div>';
    }
    public function displaySearch($book){
        $books_displayed = '
        <div class="col-lg-3">
        <div class="ibox">
        <div class="ibox-content product-box">
        <div class="product-imitation">';

        $books_displayed .= $this->displayImage($book);
        $books_displayed .= '</div> <div class="product-desc">';
        $books_displayed .= $this->displayPrice($book);
        $books_displayed .= $this->displayISBN($book);
        $books_displayed .= $this->displayTitle($book);
        $books_displayed .= $this->displayAuthors($book);
        $books_displayed .= '<div class="small m-t-xs">'; 
        $books_displayed .= $this->displayCourseNum($book); 
        $books_displayed .= $this->displayCondition($book);
        $books_displayed .= '</div>';
        $books_displayed .= $this->displayBuy($book).'</div> </div> </div> </div>';  
        return $books_displayed;
    }
    private function displayBuy($book){
        $str = '<div class="m-t text-right buy"> <button href="#" data-id='; 
        $str .= "\"{$book->getID()}\""; 
        $str .= 'class="btn btn-xs btn-outline btn-success bought" data-toggle="modal" data-target="#buyModal">Buy <i class="fa fa-long-arrow-right"></i> </button>
                                    </div>';
        return $str;
    }
    private function displayCondition($book){
        return '<span class="label label-danger">' . $book->getCondition() . '</span>';
    }
    private function displayCourseNum($book){
        return '<span class="label label-success">' .$book->getCourseNum().'</span> ';
    }
    private function displayAuthors($book){
        $str = '<div class="small m-t-xs"> Author(s): ';
        $str .= $this->cutString($book->getAuthors(), 25) . '</div>';
        return $str;
    }
    private function displayTitle($book){
        $str = '<a data-id=' . "\"{$book->getID()}\"" . 'data-toggle="modal" data-target="#buyModal" class="product-name bought" style="font-size:14px">'; 
        $str .= $this->cutString($book->getTitle(), 24) . '</a>';
        return $str;
    }
    private function displayISBN($book){
        return '<small class="text-muted">'. $this->checkExists($book->getIsbn()) . '</small>';
    }
    private function displayPrice($book){
        return '<span class="product-price">' .'$' . $book->getPrice() . '</span>';
    }
    private function displayImage($book) {
        return $books_displayed .= "<img style='max-height: 135px;' src=\"{$book->getCoverURL()}\">";
    }
    private function checkExists($isbn){
        return $isbn == null ? "No ISBN" : $isbn;
    }
    private function cutString($str, $max_length){
        return (strlen($str) > $max_length) ? substr($str, 0, $max_length) . '...' : $str;
    }
}
?>
