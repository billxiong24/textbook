<?php
include "connection.php";
date_default_timezone_set('America/New_York');


function addBook($username,$isbn,$title,$publish_date,$authors,$cover_url,$course_name,$course_num,$book_condition,$notes,$price){
    global $connection;
    
    $isbn = mysql_real_escape_string($isbn);
    $title = mysql_real_escape_string($title);
    $publish_date = mysql_real_escape_string($publish_date);
    $authors = mysql_real_escape_string($authors);
    $cover_url = mysql_real_escape_string($cover_url);
    $course_name = mysql_real_escape_string($course_name);
    $course_num = mysql_real_escape_string($course_num);
    $book_condition = mysql_real_escape_string($book_condition);
    $notes = mysql_real_escape_string($notes);
    
    
    $query = 'INSERT INTO books(username,isbn,title,publish_date,authors,cover_url,course_name,course_num,book_condition,notes,price) ';
    $query .= "VALUES('$username','$isbn','$title',$publish_date,'$authors','$cover_url','$course_name','$course_num','$book_condition','$notes',$price)";
    $result = mysqli_query($connection,$query);
    if(!$result){
        die('Query Failed' . mysqli_error($connection));
    }
    addNotification($username,'Added listing ',$title,$price);
    
    
}

function getBook($id){
    $id = intval($id);
    global $connection;
    $query = "SELECT * FROM books WHERE id = $id";
    $book = mysqli_query($connection, $query);
    if(!$book){
        die('Query Failed' . mysqli_error($connection));
    }
    $book = mysqli_fetch_assoc($book);
    return $book;
    
}

function search ($search){
    $search = strtolower($search);
    global $connection;
    $search = mysql_real_escape_string($search);
    $searchTerms = explode(' ', $search);
    $simpleWords = ['the','a','an','of','and','for','is'];
    foreach ($simpleWords as $word){  // removes all the simple words that may exist in many book titles, but not relevent to the book the user is searching
        $keys = array_keys($searchTerms,$word);
        foreach($keys as $location){
            unset($searchTerms[$location]);     
        }
            
    }
            
        
        
    $search1 = ''; // each search variable is to create a search string for every word from the user separated by a space to be searched in a column. the five search variables are for searching five columns for every space separated word from the user
    $search2 = '';
    $search3 = '';
    $search4 = '';
    $search5 = '';
    foreach ($searchTerms as $current){
        $searchTerm = '%'.$current.'%';
        $search1 = $search1 . "isbn LIKE '$current' OR ";  // does not look for number in isbn, but only for exact match isbn
        $search2 = $search2 . "title LIKE '$searchTerm' OR ";
        $search3 = $search3 . "authors LIKE '$searchTerm' OR "; 
        $search4 = $search4 . "course_name LIKE '$searchTerm' OR ";
        $search5 = $search5 . "course_num LIKE '$searchTerm' OR ";
    }
    
    $search1 = substr($search1, 0, -4);
    $search2 = substr($search2, 0, -4);
    $search3 = substr($search3, 0, -4);
    $search4 = substr($search4, 0, -4);
    $search5 = substr($search5, 0, -4);
    
    $query = "SELECT * FROM books WHERE $search1 OR $search2 OR $search3 OR $search4 OR $search5 ORDER BY price ASC";
    //$search = '%'.$search.'%';
//    $query = "SELECT * FROM books WHERE isbn LIKE '$search' OR title LIKE '$search' OR authors LIKE '$search' OR course_name LIKE '$search' OR course_num LIKE '$search' ORDER BY price ASC";
    $result = mysqli_query($connection,$query);
    if(!$result){
        die('Query Failed' . mysqli_error($connection));
    }
    $books = array();
    while($row = mysqli_fetch_assoc($result)){
        array_push($books, $row);
        
    }  
    return $books;
}

function getUser($username){
    global $connection;
    $query = "SELECT * FROM users WHERE username = '$username' ";
    $result = mysqli_query($connection, $query);
    return mysqli_fetch_assoc($result);
    
    
}

function addUser($username,$name,$phone_num,$email){
    global $connection;
    
    $username = mysql_real_escape_string($username);
    $name = mysql_real_escape_string($name);
    $phone_num = mysql_real_escape_string($phone_num);
    $email = mysql_real_escape_string($email);
    
    $query = 'INSERT INTO users(username,name,phone_num,email) ';
    $query .= "VALUES ('$username','$name','$phone_num','$email')";
    
    $result = mysqli_query($connection,$query);
    if(!$result){
        die('Query Failed' . mysqli_error($connection));
    }
    
}

function getCurrentListings($username){
    global $connection;
    $listings = array();
    $query = "SELECT * FROM books WHERE username = '$username' ";
    $result = mysqli_query($connection, $query);
    
    while ($book = mysqli_fetch_assoc($result)){
        array_push($listings, $book);
    }
    return $listings;  
    
}

function boughtBooks($username){
    global $connection;
    $boughtBooks = array();
    $query = "SELECT * FROM transaction_history WHERE buyer = '$username' ";
    $result = mysqli_query($connection, $query);
    
    while ($book = mysqli_fetch_assoc($result)){
        array_push($boughtBooks, $book);
    }
    return $boughtBooks; 
    
    
    
}

function soldBooks($username){
    global $connection;
    $soldBooks = array();
    $query = "SELECT * FROM transaction_history WHERE seller = '$username' ";
    $result = mysqli_query($connection, $query);
    
    while ($book = mysqli_fetch_assoc($result)){
        array_push($soldBooks, $book);
    }
    return $soldBooks; 
        
}

function accountOverview($username){
    $info = array();
    $boughtBooks = boughtBooks($username);
    $soldBooks = soldBooks($username);
    $spent = 0;
    $money_made = 0;
    foreach ($boughtBooks as $book) {
        $spent += $book['price'];    
    }

    foreach ($soldBooks as $book) {
        $money_made += $book['price'];    
    }
    $profit = $money_made - $spent;
    
    $info['books_bought'] = count($boughtBooks);
    $info['spent'] = $spent;
    $info['books_sold'] = count($soldBooks);
    $info['money_made'] = $money_made;
    $info['profit'] = $profit;
    
    return $info;

}

function removeListing($book_id){
    global $connection;
    $query = "DELETE FROM books ";
    $query .= "WHERE id = $book_id ";
    $result = mysqli_query($connection, $query); //making it a variable to check if it works
    if(!$result){
        die('Query Failed' . mysqli_error($connection));
    }   
    
}

function buyBook($buyer,$book_id){
    global $connection;
    $book = getBook($book_id);
    
    $seller = $book['username'];
    $trans_date = time();
    $isbn = $book['isbn'];
    $title = $book['title'];
    $publish_date = $book['publish_date'];
    $authors = $book['authors'];
    $cover_url = $book['cover_url'];
    $course_name = $book['course_name'];
    $course_num = $book['course_num'];
    $book_condition = $book['book_condition'];
    $notes = $book['notes'];
    $price = $book['price'];
    
    $query = 'INSERT INTO transaction_history(buyer,seller,trans_date,isbn,title,publish_date,authors,cover_url,course_name,course_num,book_condition,notes,price) ';
    $query .= "VALUES('$buyer','$seller',$trans_date,'$isbn','$title',$publish_date,'$authors','$cover_url','$course_name','$course_num','$book_condition','$notes',$price)";
    $result = mysqli_query($connection,$query);
    if(!$result){
        die('Query Failed' . mysqli_error($connection));
    }
    
    removeListing($book_id);
    addNotification($buyer,'Bought',$title,$price);
    addNotification($seller,'Someone bought',$title,$price);
    
    
}

function addNotification($username,$action,$title,$price){
    global $connection;
    $timestamp = time();
    $query = "INSERT INTO notifications(username,action,timestamp,title,price) ";
    $query .= "VALUES('$username','$action',$timestamp,'$title',$price)";
    $result = mysqli_query($connection,$query);
    if(!$result){
        die('Query Failed' . mysqli_error($connection));
    }  
    
}

function getNotifications($username){
    
    global $connection;
    $query = "SELECT * FROM notifications WHERE username = '$username' ORDER BY timestamp DESC";
    $result = mysqli_query($connection,$query);
    if(!$result){
        die('Query Failed' . mysqli_error($connection));
    }  
    $formattedNotification = '';
    $counter = 0; 
    $unread = 0; // will count number of new notifications
    while ($counter<5){
        $notif = mysqli_fetch_assoc($result);
        if ($notif['looked_at']==0){
                    $formattedNotification = $formattedNotification."
               <li>
                <a href='myAccount.php'>
                    <div style='color: red;'>
                        <i class='fa fa-envelope fa-fw'></i> {$notif['action']} {$notif['title']} for \${$notif['price']}
                        <span style='color: red;'class='pull-right text-muted small'>4 minutes ago</span>
                    </div>
                </a>
            </li>
            <li class='divider'></li>";
            $unread++;
            
        }
        else {
            $formattedNotification = $formattedNotification."
               <li>
                <a href='myAccount.php'>
                    <div>
                        <i class='fa fa-envelope fa-fw'></i> {$notif['action']} {$notif['title']} for \${$notif['price']}
                        <span class='pull-right text-muted small'>4 minutes ago</span>
                    </div>
                </a>
            </li>
            <li class='divider'></li>";
            
            
        }

        
    $counter++;    
    }
    $formattedNotification = $formattedNotification." 
            <li>
                <li>
                    <div class='text-center link-block'>
                        <a href='notifications.php'>
                            <strong>See All Alerts</strong>
                            <i class='fa fa-angle-right'></i>
                        </a>
                    </div>
                </li>";                               
    
    return array("unread"=>$unread,"notifications"=>$formattedNotification);
    
    
}

function readNotifications($username){ //called when a user clicks on the notifications tab and all are checked as read
    global $connection;
    $query = "UPDATE notifications SET looked_at = 1 WHERE username = '$username' ";
    $result = mysqli_query($connection,$query);
    if(!$result){
        die('Query Failed' . mysqli_error($connection));
    }    
    
}


?>