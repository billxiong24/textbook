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

function search ($search, $price, $condition){
    $price_search = '';
    $condition_search = '';
    if ($price != 'Any'){
        $price_search = "AND price < $price";     
    }
    
    if($condition != 'Any'){ //
        $condition_search = "AND book_condition = '$condition'";
    }
    
    $search = strtolower($search);
    global $connection;
    $search = mysqli_real_escape_string($connection, $search);
//    $searchTerms = explode(' ', $search);
//    $simpleWords = ['the','a','an','of','and','for','is'];
//    foreach ($simpleWords as $word){  // removes all the simple words that may exist in many book titles, but not relevent to the book the user is searching
//        $keys = array_keys($searchTerms,$word);
//        foreach($keys as $location){
//            unset($searchTerms[$location]);     
//        }
//            
//    }
//            
//        
//    if (count($searchTerms) == 0){  
//        $searchTerms[0] = '';
//    }
//    
//    $search1 = ''; // each search variable is to create a search string for every word from the user separated by a space to be searched in a column. the five search variables are for searching five columns for every space separated word from the user
//    $search2 = '';
//    $search3 = '';
//    $search4 = '';
//    $search5 = '';
//    foreach ($searchTerms as $current){
//        $searchTerm = '%'.$current.'%';
//        $search1 = $search1 . "isbn LIKE '$current' OR ";  // does not look for number in isbn, but only for exact match isbn
//        $search2 = $search2 . "title LIKE '$searchTerm' OR ";
//        $search3 = $search3 . "authors LIKE '$searchTerm' OR "; 
//        $search4 = $search4 . "course_name LIKE '$searchTerm' OR ";
//        $search5 = $search5 . "course_num LIKE '$searchTerm' OR ";
//    }
//    
//    $search1 = substr($search1, 0, -4);
//    $search2 = substr($search2, 0, -4);
//    $search3 = substr($search3, 0, -4);
//    $search4 = substr($search4, 0, -4);
//    $search5 = substr($search5, 0, -4);
//    $query = "SELECT * FROM books WHERE ($search1 OR $search2 OR $search3 OR $search4 OR $search5) $price_search $condition_search ORDER BY price ASC";
    $query = "SELECT * FROM books WHERE MATCH(isbn,title,authors,course_name,course_num) AGAINST('$search') $price_search $condition_search";
    
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
    
    $books_displayed = '';
    
     $books_displayed = $books_displayed .'<div class="row">';
            for($i=0; $i<count($books); $i++){  // printing out a grid of books from the php data loaded at the top of the file
//                if ($i != 0 && $i%4 == 0){
//                    $books_displayed = $books_displayed .'</div>';
//                }
//                if ($i != 0 && $i%4 == 0){
//                    $books_displayed = $books_displayed . '<div class="row">'; // for creating rows of books displayed 
//                }
               $books_displayed = $books_displayed .'
                <div class="col-lg-3">
                    <div class="ibox">
                        <div class="ibox-content product-box">

                            <div class="product-imitation">';
                            
                            $books_displayed = $books_displayed . "<img style='max-height: 135px;' src=\"{$books[$i]['cover_url']}\">";
                                
                            $books_displayed = $books_displayed . '</div>
                            <div class="product-desc">
                                <span class="product-price">';
                                 $books_displayed = $books_displayed .'$'.$books[$i]['price'];
                                $books_displayed = $books_displayed . '</span>
                                <small class="text-muted">'; $books_displayed = $books_displayed . $books[$i]['isbn']; $books_displayed = $books_displayed . '</small>
                                <a data-id=' . "\"{$books[$i]['id']}\"" . 'data-toggle="modal" data-target="#buyModal" class="product-name bought">'; 
                                $str = $books[$i]['title'];
                                if(strlen($str) > 24){
                                    $cut = substr($str, 0, 24). "...";
                                    $books_displayed = $books_displayed . $cut;
                                }
                                else{
                                    $books_displayed = $books_displayed . $str;
                                }
                                 

                                $books_displayed = $books_displayed . '</a>';
                                    $books_displayed = $books_displayed . '<div class="small m-t-xs"> Author(s): ';
                                    $authors = $books[$i]['authors'];
                                    if(strlen($authors) > 20){
                                        $books_displayed = $books_displayed . substr($authors, 0, 20) . "...";
                                    }
                                    else{
                                        $books_displayed = $books_displayed . $authors;
                                    }
                                $books_displayed = $books_displayed . '</div>';
                                $books_displayed = $books_displayed .
                                '<div class="small m-t-xs">
                                <span class="label label-success">'; $books_displayed = $books_displayed . $books[$i]['course_num']; $books_displayed = $books_displayed . '</span> 
                                <span class="label label-danger">'; $books_displayed = $books_displayed . $books[$i]['book_condition'];
                                $books_displayed = $books_displayed . '</span>
                                </div>';
                
                                $books_displayed = $books_displayed .'
                                <div class="m-t text-right buy">
                                    <button href="#" data-id='; $books_displayed = $books_displayed . "\"{$books[$i]['id']}\""; $books_displayed = $books_displayed . 'class="btn btn-xs btn-outline btn-success bought" data-toggle="modal" data-target="#buyModal">Buy <i class="fa fa-long-arrow-right"></i> </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';  
            }
            $books_displayed = $books_displayed . '</div>';
            $data = array('numResults'=>count($books),'books'=>$books_displayed);
            return $data;
}

function getUser($username){
    global $connection;
    $query = "SELECT * FROM users WHERE username = '$username' ";
    $result = mysqli_query($connection, $query);
    return mysqli_fetch_assoc($result);
}
function addUser($username,$name,$phone_num,$email){
    global $connection;
    
    $username = mysqli_real_escape_string($connection, $username);
    $name = mysqli_real_escape_string($connection, $name);
    $phone_num = mysqli_real_escape_string($connection, $phone_num);
    $email = mysqli_real_escape_string($connection, $email);
    
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
    return array_reverse($listings);  // first books are most recent
    
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

function findBookHistory($id){
    global $connection;
    $query = "SELECT * FROM transaction_history WHERE id = $id";
    $result = mysqli_query($connection, $query);
    return mysqli_fetch_assoc($result);    
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
    
    $buyer = mysqli_real_escape_string($connection, $buyer);
    $seller = mysqli_real_escape_string($connection, $seller);
    $isbn = mysqli_real_escape_string($connection, $isbn);
    $title = mysqli_real_escape_string($connection, $title);
    $authors = mysqli_real_escape_string($connection, $authors);
    $course_url = mysqli_real_escape_string($connection, $course_url);
    $course_name = mysqli_real_escape_string($connection, $course_name);
    $course_num = mysqli_real_escape_string($connection, $course_num);
    $notes = mysqli_real_escape_string($connection, $notes);
    
    $query = 'INSERT INTO transaction_history(id,buyer,seller,trans_date,isbn,title,publish_date,authors,cover_url,course_name,course_num,book_condition,notes,price) ';
    $query .= "VALUES($book_id,'$buyer','$seller',$trans_date,'$isbn','$title',$publish_date,'$authors','$cover_url','$course_name','$course_num','$book_condition','$notes',$price)";
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
        $link = './myAccount.php#purchase-history';
        $header=$notif['action'];
        if($notif['action'] == 'Bought'){
            $icon = 'fa fa-shopping-cart';
            $header = 'Bought';
            $color = "#EF4836"; //red
        }
        else if($notif['action'] == 'Someone bought'){
            $icon = 'fa fa-usd';
            $header = 'Sold';
            $link='./myAccount.php#sold';
        }
        else if (trim($notif['action']) == 'Added listing'){
            $icon = 'fa fa-plus';
            $header = 'Added Listing';
            $color = "#19B5FE"; //light blue
            $link='./myAccount.php#listings';
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
    while ($notif = mysqli_fetch_assoc($result)){
        
        $info = "{$notif['action']} {$notif['title']} for \${$notif['price']}";
        $link = './myAccount.php';
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
                    <div style='color: darkred; background-color: white;'>
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
                    <div style='color:#535353; background-color: white;'>
                        <i class='$icon fa-fw'></i> {$info}
                        <span class='pull-right text-muted small'>{$time}</span>
                    </div>
                </a>
            </li>
            <li class='divider'></li>";
            
            
        }

        
    $counter++;
    if($counter >= 5)
        break;
            
    }
    $formattedNotification = $formattedNotification." 
                <li>
                    <div class='text-center link-block notif-color' style='background-color: #001A57; opacity: 0.9'>
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
