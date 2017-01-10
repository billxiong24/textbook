<?php
require_once("Book.class.php");
class BookBuilder{
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
    public function createBook(){
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
}
?>
