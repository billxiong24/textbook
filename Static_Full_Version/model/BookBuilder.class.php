<?php
require_once("Book.class.php");
require_once("Builder.interface.php");
class BookBuilder implements Builder{
    private $id;
    private $username;
    private $title;
    private $isbn;
    private $publish_date;
    private $authors;
    private $cover_url;
    private $course_name;
    private $course_num;
    private $condition;
    private $notes;
    private $price;
    
    public function id($id){
        $this->id = $id;
        return $this;
    }
    public function username($username){
        $this->username = $username;
        return $this;
    }
    public function title($title){
        $this->title = $title;
        return $this;
    }
    public function isbn($isbn){
        $this->isbn = $isbn;
        return $this;
    }
    public function publishDate($publish_date){
        $this->publish_date = $publish_date;
        return $this;
    }
    public function authors($authors){
        $this->authors = $authors;
        return $this;
    }
    public function coverURL($cover_url){
        $this->cover_url = $cover_url;
        return $this;
    }
    public function courseName($course_name){
        $this->course_name = $course_name;
        return $this;
    }
    public function courseNum($course_num){
        $this->course_num = $course_num;
        return $this;
    }
    public function condition($condition){
        $this->condition = $condition;
        return $this;
    }
    public function notes($notes){
        $this->notes = $notes;
        return $this;
    }
    public function price($price){
        $this->price = $price;
        return $this;
    }
    public function create(){
        return new Book($this->id,
                        $this->username,
                        $this->title, 
                        $this->isbn,
                        $this->publish_date,
                        $this->authors,
                        $this->cover_url,
                        $this->course_name,
                        $this->course_num,
                        $this->condition,
                        $this->notes,
                        $this->price);
    }
    public function createFromQuery($book){
        return $this->build($book, 'username');
    }
    public function createBookFromTransaction($book){
        return $this->build($book, 'seller');
    }
    private function build($book, $user){
        //idk why this has to be there but something weird happens if notes is empty 
        $notes = strlen($book['notes']) == 0 ? " " : $book['notes'];
        $this->username($book[$user])->isbn($book['isbn'])->title($book['title'])->publishDate($book['publish_date'])->authors($book['authors']);
        $this->coverURL($book['cover_url'])->courseName($book['course_name'])->courseNum($book['course_num'])->condition($book['book_condition'])->notes($notes);
        $this->price($book['price'])->id($book['id']);
        return $this->create();
    }
}
?>
