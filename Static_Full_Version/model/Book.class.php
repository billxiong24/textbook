<?php
class Book{
    private $id;
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

    public function __construct($id,
                                $title, 
                                $isbn,
                                $publish_date,
                                $authors,
                                $cover_url,
                                $course_name,
                                $course_num,
                                $condition,
                                $notes,
                                $price){
        $this->id = $id;
        $this->title = $title;                            
        $this->isbn = $isbn;                            
        $this->publish_date = $publish_date;                            
        $this->authors = $authors;                            
        $this->cover_url = $cover_url;                            
        $this->course_name = $course_name;                            
        $this->course_num = $course_num;                            
        $this->condition = $condition;                            
        $this->notes = $notes;                            
        $this->price = $price;                            
    }
    public function getID(){
        return $this->id;
    }
    public function getTitle(){
        return $this->title;
    }
    public function getIsbn(){
        return $this->isbn;
    }
    public function getPublishDate(){
        return $this->publish_date;
    }
    public function getAuthors(){
        return $this->authors;
    }
    public function getCoverURL(){
        return $this->cover_url;
    }
    public function getCourseName(){
        return $this->course_name;
    }
    public function getCourseNum(){
        return $this->course_num;
    }
    public function getCondition(){
        return $this->condition;
    }
    public function getNotes(){
        return $this->notes;
    }
    public function getPrice(){
        return $this->price;
    }
}
?>
