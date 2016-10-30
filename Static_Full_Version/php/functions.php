<?php
include "connection.php";
date_default_timezone_set('America/New_York');


function addBook($username,$isbn,$title,$publish_date,$authors,$cover_url,$course_name,$course_num,$book_condition,$notes,$price){
    global $connection;
    
    $isbn = mysqli_real_escape_string($connection, $isbn);
    $title = mysqli_real_escape_string($connection, $title);
    $publish_date = mysqli_real_escape_string($connection, $publish_date);
    $authors = mysqli_real_escape_string($connection, $authors);
    $cover_url = mysqli_real_escape_string($connection, $cover_url);
    $course_name = mysqli_real_escape_string($connection, $course_name);
    $course_num = mysqli_real_escape_string($connection, $course_num);
    $book_condition = mysqli_real_escape_string($connection, $book_condition);
    $notes = mysqli_real_escape_string($connection, $notes);
    
    
    $query = 'INSERT INTO books(username,isbn,title,publish_date,authors,cover_url,course_name,course_num,book_condition,notes,price) ';
    $query .= "VALUES('$username','$isbn','$title',$publish_date,'$authors','$cover_url','$course_name','$course_num','$book_condition','$notes',$price)";
    $result = mysqli_query($connection,$query);
    if(!$result){
        die('Query Failed' . mysqli_error($connection));
    }
    addNotification($username,'Added listing',$title,$price);
    
    
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
    $search = mysqli_real_escape_string($connection, $search);
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
    $query = "SELECT * FROM transaction_history WHERE buyer = '$username' ORDER BY trans_date DESC";
    $result = mysqli_query($connection, $query);
    
    while ($book = mysqli_fetch_assoc($result)){
        array_push($boughtBooks, $book);
    }
    return $boughtBooks; 
    
    
    
}

function soldBooks($username){
    global $connection;
    $soldBooks = array();
    $query = "SELECT * FROM transaction_history WHERE seller = '$username' ORDER BY trans_date DESC";
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
function time_elapsed_string($ptime)// time elapsed function from stackoverflow http://stackoverflow.com/questions/1416697/converting-timestamp-to-time-ago-in-php-e-g-1-day-ago-2-days-ago
{
    $etime = time() - $ptime;

    if ($etime < 1)
    {
        return '0 seconds';
    }

    $a = array( 365 * 24 * 60 * 60  =>  'year',
                 30 * 24 * 60 * 60  =>  'month',
                      24 * 60 * 60  =>  'day',
                           60 * 60  =>  'hour',
                                60  =>  'minute',
                                 1  =>  'second'
                );
    $a_plural = array( 'year'   => 'years',
                       'month'  => 'months',
                       'day'    => 'days',
                       'hour'   => 'hours',
                       'minute' => 'minutes',
                       'second' => 'seconds'
                );

    foreach ($a as $secs => $str)
    {
        $d = $etime / $secs;
        if ($d >= 1)
        {
            $r = round($d);
            return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
        }
    }
}
function getNotificationArray($username){
     global $connection;
    $query = "SELECT * FROM notifications WHERE username = '$username' ORDER BY timestamp DESC";
    $result = mysqli_query($connection,$query);
    if(!$result){
        die('Query Failed' . mysqli_error($connection));
    }  
    $formattedNotification = '';
    while ($notif = mysqli_fetch_assoc($result)){
        $info = "{$notif['action']} {$notif['title']} for \${$notif['price']}.";
        $time = time_elapsed_string($notif['timestamp']);
        $icon = '';
        $color = "#00B16A";
        $link = '/textbook/Static_Full_Version/myAccount.php#purchase-history';
        $header=$notif['action'];
        if($notif['action'] == 'Bought'){
            $icon = 'fa fa-shopping-cart';
            $header = 'Bought';
            $color = "#EF4836"; //red
        }
        else if($notif['action'] == 'Someone bought'){
            $icon = 'fa fa-usd';
            $header = 'Sold';
            $link='/textbook/Static_Full_Version/myAccount.php#sold';
        }
        else if (trim($notif['action']) == 'Added listing'){
            $icon = 'fa fa-plus';
            $header = 'Added Listing';
            $color = "#19B5FE"; //light blue
            $link='/textbook/Static_Full_Version/myAccount.php#listings';
        }

        echo"               <div class='vertical-timeline-block'>
                                <div class='vertical-timeline-icon' style='color: #fff; background-color: $color'>
                                    <i class='$icon'></i>
                                </div>
                                <div class='vertical-timeline-content'>
                                    <h2>{$header}</h2>
                                    <p class='query-message'>{$info}
                                    </p>
                                    
                                    <a class='btn btn-sm btn-primary' href='$link'>Details</a>
                                    
                                    <span class='vertical-date'>
                                         <br/>
                                        <small>{$time}</small>
                                    </span>
                                </div>
                            </div>";
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
        $info = "{$notif['action']} {$notif['title']} for \${$notif['price']}";
        $link = '/textbook/Static_Full_Version/myAccount.php';
        if(strlen($info)>=39){ // cuts off the notification string if it is too long so it can fit in the notifications box
            $info = substr($info,0,38);
            $info = $info.'...'; 
        }
        $time = time_elapsed_string($notif['timestamp']);
        $icon = '';
        if($notif['action'] == 'Bought'){
            $icon = 'fa fa-shopping-cart';
            $link .='#purchase-history';
        }
        else if($notif['action'] == 'Someone bought'){
            $icon = 'fa fa-usd';
            $link .= '#sold';
        }
        else if ($notif['action'] == 'Added listing'){
            $icon = 'fa fa-plus';
            $link .= '#listings';
        }
        
        
        
        if ($notif['looked_at']==0){
                    $formattedNotification = $formattedNotification."
               <li>
                <a href='$link'>
                    <div style='color: red;'>
                        <i class='$icon fa-fw'></i> {$info}
                        <span style='color: red;'class='pull-right text-muted small'>{$time}</span>
                    </div>
                </a>
            </li>
            <li class='divider'></li>";
            $unread++;
            
        }
        else {
            $formattedNotification = $formattedNotification."
               <li>
                <a href='$link'>
                    <div style='color:#535353'>
                        <i class='$icon fa-fw'></i> {$info}
                        <span class='pull-right text-muted small'>{$time}</span>
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
                    <div class='text-center link-block notif-color' style='background-color: #001A57; opacity: 0.9'>
                        <form method ='post' action='notifications.php'>
                        <a href='notifications.php'>
                            <strong>See All Alerts</strong>
                            <i class='fa fa-angle-right'></i>
                        </a>
                        </form>
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