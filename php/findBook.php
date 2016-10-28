<?php
if(isset($_POST['search'])){
    $search = $_POST['search'];
    $search = str_replace(" ","%20",$search);
    $url ="https://www.googleapis.com/books/v1/volumes?q=$search&key=AIzaSyAgvLVTx6PZHbRLYN7MrtstuHhzjQHYJN0"; // searchs any query in google books
    $response = file_get_contents($url);
    $response = json_decode($response,true);
    if (array_key_exists('error',$response)){
        $return_array = array("isbn"=>"","title"=>"","date"=>"","authors"=>"","cover"=>"");   
    }
    else {
        $isbn = $response['items'][0]['volumeInfo']['industryIdentifiers'][0]['identifier'];
        $title = $response['items'][0]['volumeInfo']['title'];
        $date = $response['items'][0]['volumeInfo']['publishedDate'];
        $authors = $response['items'][0]['volumeInfo']['authors'];
        $authorString = '';
        for ($i=0; $i<count($authors)-1; $i++){
            $authorString = $authorString . $authors[$i] . ", ";
        }
        $authorString = $authorString . $authors[count($authors)-1];
        if (array_key_exists('imageLinks',$response['items'][0]['volumeInfo'])){ // checks for thumbnail pic in first entry
            $cover = $response['items'][0]['volumeInfo']['imageLinks']['thumbnail'];

       }
        else {
           $cover = '';
        }
        $return_array= array("isbn"=>$isbn,"title"=>$title,"date"=>$date,"authors"=>$authorString,"cover"=>$cover);
    }
    echo json_encode($return_array);
    
       
}


?>