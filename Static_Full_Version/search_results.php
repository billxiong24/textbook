<?php
include "./php/functions.php";
session_start();
if(!isset($_SESSION['username'])){
    header('Location: index.php');
}
if (isset($_POST['search'])){
    $result = search($_POST['search']);
}
else {
    $result = array();
}
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Search</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

        <!-- Toastr style -->
        <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">

        <!-- Gritter -->
        <link href="js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

        <link href="css/animate.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/search_results.css" rel="stylesheet">

    </head>

    <body>
        <div id="buyModal" class="modal inmodal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Confirm Purchase</h4>
                        <small class="font-bold">Click Buy to continue with purchase.</small>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-6">
                            <div class="ibox">
                                <div class="ibox-content product-box">

                                    <div id='pic' class="product-imitation">
                                        Book Cover
                                    </div>
                                    <div class="product-desc">
                                        <span id='productPrice' class="product-price"></span>
                                        <a href="#" id='book_title' class="product-name"></a>

                                        <!--
                                        <div class="small m-t-xs">
                                            Many desktop publishing packages and web page editors now.
                                        </div>
-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sell-info">
                            <p id='seller'></p>
                            <p id='email'></p>
                            <p id='phone_num'></p>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button id="buy" type="button" class="btn btn-outline btn-primary">Buy</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="wrapper">

            <nav class="navbar-default navbar-static-side" role="navigation">
                <div class="logo">
                    <a href="home.php">Duke <span class="smaller">EXCHANGE</span></a>
                </div>
                <div class="sidebar-collapse">

                </div>


                <div class="filter-message">
                    <h2 style="color: #E8E8E8;"><i class="fa fa-filter"></i><span style="margin-left: 10px;">Filter search</span></h2>


                </div>


                <div class="search-filter">
                    <div class="ibox float-e-margins">
                        <div class="filter ibox-content">

                            <small class="labels">Price: </small>
                            <ul class="list1 todo-list m-t small-list">
                                <li style="background-color: #FAFAFA">
                                    <a href="#" class="check-link"><i class="howdy fa fa-square-o"></i> </a>
                                    <span class="m-l-xs">Under $5</span>
                                </li>
                                <li style="background-color: #FAFAFA">
                                    <a href="#" class="check-link"><i class="fa fa-square-o"></i> </a>
                                    <span class="m-l-xs">Under $15</span>

                                </li>
                                <li style="background-color: #FAFAFA">
                                    <a href="#" class="check-link"><i class="fa fa-square-o"></i> </a>
                                    <span class="m-l-xs">Under $30</span>
                                </li>
                                <li style="background-color: #FAFAFA">
                                    <a href="#" class="check-link"><i class="fa fa-square-o"></i> </a>
                                    <span class="m-l-xs">Any</span>
                                </li>
                            </ul>
                            <p></p>
                            <small class="labels">Condition: </small>
                            <ul class="list2 todo-list m-t small-list">
                                <li style="background-color: #FAFAFA">
                                    <a href="#" class="check-link"><i class="howdy fa fa-square-o"></i> </a>
                                    <span class="m-l-xs">New</span>
                                </li>
                                <li style="background-color: #FAFAFA">
                                    <a href="#" class="check-link"><i class="fa fa-square-o"></i> </a>
                                    <span class="m-l-xs">Good</span>

                                </li>
                                <li style="background-color: #FAFAFA">
                                    <a href="#" class="check-link"><i class="fa fa-square-o"></i> </a>
                                    <span class="m-l-xs">Fair</span>
                                </li>
                                <li style="background-color: #FAFAFA">
                                    <a href="#" class="check-link"><i class="fa fa-square-o"></i> </a>
                                    <span class="m-l-xs">Any</span>
                                </li>
                            </ul>
                        </div>

                    </div>

                </div>

            </nav>


            <div id="page-wrapper">
                <div class="row logo-align">
                    <nav class="navbar navbar-static-top ibox float-e-margins" role="navigation">
                        <div class="navbar-header">
                            <button style="" aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                                <i class="fa fa-reorder"></i>
                            </button>
                            <a href="#" class="navbar-brand"></a>
                        </div>
                        <div class="navbar-collapse collapse" id="navbar">
                            <ul class="nav navbar-nav navbar-right">
                                <li>
                                    <a aria-expanded="false" role="button" href="home.php"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                                </li>
                                <li>
                                    <a aria-expanded="false" role="button" href="sell_integrated.php"><i class="fa fa-tag" aria-hidden="true"></i>Sell</a>
                                </li>

                                <li>
                                    <a aria-expanded="false" role="button" href="myAccount.php"><i class="fa fa-bars" aria-hidden="true"></i>My Account</a>
                                </li>
                                <li id="readNotifications" class="dropdown">
                                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                        <i class="fa fa-bell"></i> <span id="unreadNotifications" class="label label-primary"></span> Notifications
                                    </a>
                                    <ul id='notifications' class="dropdown-menu dropdown-alerts" style="width: 300%">

                                    </ul>

                                </li>
                                <li>
                                    <a href="./php/logout.php">
                                        <i class="fa fa-sign-out" aria-hidden="true"></i>Log out
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </nav>
                </div>


                <!-- <div class="recommend rec-message">
            <span>Search Results for "Some search"</span>
        </div> -->
                <div class="wrapper wrapper-content animated fadeInRight">


                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-content">
                                    <h2>
                                <?php echo count($result); ?> results found for: <span style="color: #001A57"><?php echo $_POST['search']; ?></span>
                            </h2>

                                    <div class="search-form">
                                        <form action="search_results.php" method="post">
                                            <div class="input-group">
                                                <input type="text" placeholder="Search ISBN, Title, Author, or Class" name="search" class="form-control input-lg">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-lg btn-primary space" type="submit">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>

                                    <?php //print_r($result); ?>

                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
            echo '<div class="row">';
            for($i=0; $i<count($result); $i++){  // printing out a grid of books from the php data loaded at the top of the file
                if ($i != 0 && $i%4 == 0){
                    echo '</div>';
                }
                if ($i != 0 && $i%4 == 0){
                    echo '<div class="row">'; // for creating rows of books displayed 
                }
                echo'
                <div class="col-md-3">
                    <div class="ibox">
                        <div class="ibox-content product-box">

                            <div class="product-imitation">';
                            
                            echo "<img src=\"{$result[$i]['cover_url']}\">";
                                
                            echo '</div>
                            <div class="product-desc">
                                <span class="product-price">';
                                 echo '$'.$result[$i]['price'];
                                echo '</span>
                                <small class="text-muted">'; echo $result[$i]['isbn']; echo '</small>
                                <a href="#" class="product-name">'; echo $result[$i]['title']; echo '</a>
                                <div class="small m-t-xs">';
                                    echo 'Author(s): '.$result[$i]['authors'];
                                echo '</div>
                                <div class="small m-t-xs">
                                <p><span class="label label-success">'; echo $result[$i]['course_num']; echo '</span> 
                                <span class="label label-danger">'; echo $result[$i]['book_condition'];
                                echo '</span></p>
                                </div>';
                
                                echo'
                                <div class="m-t text-right buy">
                                    <button href="#" data-id ='; echo "\"{$result[$i]['id']}\""; echo 'class="btn btn-xs btn-outline btn-success bought" data-toggle="modal" data-target="#buyModal">Buy <i class="fa fa-long-arrow-right"></i> </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
                
                
                
            }
            echo '</div>';
            ?>

                </div>
            </div>

        </div>

        <!-- Mainly scripts -->

        <script src="js/jquery-2.1.1.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

        <!-- Flot -->
        <script src="js/plugins/flot/jquery.flot.js"></script>
        <script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
        <script src="js/plugins/flot/jquery.flot.spline.js"></script>
        <script src="js/plugins/flot/jquery.flot.resize.js"></script>
        <script src="js/plugins/flot/jquery.flot.pie.js"></script>

        <!-- Peity -->
        <script src="js/plugins/peity/jquery.peity.min.js"></script>
        <script src="js/demo/peity-demo.js"></script>

        <!-- Custom and plugin javascript -->
        <script src="js/inspinia.js"></script>
        <!-- <script src="js/plugins/pace/pace.min.js"></script> -->

        <!-- jQuery UI -->
        <script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>

        <!-- GITTER -->
        <script src="js/plugins/gritter/jquery.gritter.min.js"></script>

        <!-- Sparkline -->
        <script src="js/plugins/sparkline/jquery.sparkline.min.js"></script>

        <!-- Sparkline demo data  -->
        <script src="js/demo/sparkline-demo.js"></script>

        <!-- ChartJS-->
        <script src="js/plugins/chartJs/Chart.min.js"></script>

        <!-- Toastr -->
        <script src="js/plugins/toastr/toastr.min.js"></script>
        <!-- Custom script -->
        <script src="js/frontpage.js">
        </script>

        <script>
            $(document).ready(function () {

                var bookID; // used to store the book id for other functions on this page
                $('.bought').click(function (evt) {
                    bookID = $(this).data("id");
                    $.ajax({
                        type: 'POST',
                        data: {
                            bookID: $(this).data("id")
                                //id of book stored in buy link
                        },
                        url: './php/get_book_details.php',
                        dataType: "json",
                        success: function (data) {

                            if (!data.error) { // this sort of json accessing data only works in ajax
                                var seller = '<strong>Seller: </strong>' + data.seller;
                                var email = '<strong>Email: </strong>' + data.email;
                                var phone_num = '<strong>Phone: </strong>' + data.phone_num;
                                var pic = "<img src=\"" + data.pic + "\">";
                                var price = '$' + data.price;
                                //alert(seller);
                                $('#seller').html(seller);
                                $('#email').html(email);
                                $('#phone_num').html(phone_num);
                                $('#productPrice').html(price);
                                $('#pic').html(pic);
                                $('#book_title').html(data.title);

                            }

                        }
                    });

                });

                $('#buy').click(function (evt) {
                    $.ajax({
                        type: 'POST',
                        data: {
                            bookID: bookID
                                //id of book stored in buy link
                        },
                        url: './php/buy_book.php',
                        dataType: "text",
                        success: function (data) {
                            if (!data.error) { // this sort of json accessing data only works in ajax
                                $('#buyModal').delay(1000).modal('hide');
                                window.location.replace('./myAccount.php');

                            }
                        }
                    });

                });

                refresh = setInterval(function () {
                    refreshNotifications();

                }, 1000);

                function refreshNotifications() {
                    $.ajax({
                        url: './php/refreshNotifications.php',
                        dataType: "json",
                        success: function (data) {
                            if (!data.error) { // this sort of json accessing data only works in ajax
                                if (data.unread != 0) { // wont display notifications label if none exist
                                    $('#unreadNotifications').html(data.unread);
                                    $('#notifications').html(data.notifications);
                                } else {
                                    $('#unreadNotifications').html('');
                                    $('#notifications').html(data.notifications);
                                }



                            }
                        }
                    });
                }

                $('#readNotifications').click(function (evt) {
                    $(document).click(function () {
                        $.ajax({
                            url: './php/readNotifications.php',
                            success: function (data) {}
                        });


                    });

                });

            });
        </script>
    </body>

    </html>