<?php
include './php/functions.php';
session_start();
if(!isset($_SESSION['username'])){
    header('Location: index.php');
}
if (isset($_POST['search'])){
    $_SESSION['search'] = $_POST['search'];
}
else {
    header("Location: home.php");
}

?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>
            <?php echo $_POST['search'] ?> - Duke Exchange</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

        <!-- Gritter -->
        <link href="js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

        <link href="css/animate.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/home.css" rel="stylesheet">
        <link href="css/search_results.css" rel="stylesheet">

    </head>

    <body class='top-navigation'>
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
                                        <small id='isbn' class="text-muted"></small>
                                        <a href="#" id='book_title' class="product-name"></a>

                                        <div id='authors' class="small m-t-xs"> </div>
                                        <div class="small m-t-xs">
                                                <span id='course_num' class="label label-success"></span>
                                                <span id='book_condition' class="label label-danger"></span>
                                        </div>

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
                        <button id="buy" type="button" class="btn btn-white buy-modal-button">Buy</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="wrapper">
            <div id="page-wrapper">
                <?php include 'navbar.php'; ?>
                    <!-- <div class="recommend rec-message">
            <span>Search Results for "Some search"</span>
        </div> -->
                    <div class="wrapper wrapper-content animated fadeInRight">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-content">
                                        <h2>
                                <span id="numResults"></span> results found for: <span style="color: #001A57"><?php echo $_POST['search']; ?></span>
                            </h2>

                                        <div class="search-form">
                                            <form action="search_results.php" method="post">
                                                <div class="input-group">
                                                    <input type="text" placeholder="Search ISBN, Title, Author, or Class" name="search" class="form-control input-lg">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-lg btn-primary space" type="submit">
                                                            <i class="fa fa-search"></i>
                                                        </button>
                                                        <li class="dropdown" style="display: inline; margin-left: 5px;">
                                                            <a class="dropdown-toggle count-info btn btn-lg btn-primary space" id="filter" data-toggle="dropdown" href="#">
                                                                <i class="fa fa-filter"></i>
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-alerts pull-right todo-list m-t" style=" margin-top: 20px;  width: 250px; padding-top: 5px;">
                                                                <span class="labels">Price: </span>
                                                                <li class="price">
                                                                    <label>
                                                                        <input type="checkbox" value="" name="" class="i-checks" />
                                                                        <span class="m-l-xs">Under $5</span>
                                                                    </label>
                                                                </li>
                                                                <li class="price">
                                                                    <label>
                                                                        <input type="checkbox" value="" name="" class="i-checks" />
                                                                        <span class="m-l-xs">Under $10</span>
                                                                    </label>
                                                                </li>
                                                                <li class="price">
                                                                    <label>
                                                                        <input type="checkbox" value="" name="" class="i-checks" />
                                                                        <span class="m-l-xs">Under $20</span>
                                                                    </label>
                                                                </li>
                                                                <li class="price">
                                                                    <label>
                                                                        <input type="checkbox" value="" name="" class="i-checks" />
                                                                        <span class="m-l-xs">Under $30</span>
                                                                    </label>

                                                                </li>
                                                                <li class="price">
                                                                    <label>
                                                                        <input type="checkbox" value="" name="" class="i-checks" />
                                                                        <span class="m-l-xs">Any</span>
                                                                    </label>

                                                                </li>
                                                                <span class="labels">Condition:</span>
                                                                <li class="cond">
                                                                    <label>
                                                                        <input type="checkbox" value="" name="" class="i-checks" />
                                                                        <span class="m-l-xs">New</span>
                                                                    </label>

                                                                </li>
                                                                <li class="cond">
                                                                    <label>
                                                                        <input type="checkbox" value="" name="" class="i-checks" />
                                                                        <span class="m-l-xs">Good</span>
                                                                    </label>
                                                                </li>
                                                                <li class="cond">
                                                                    <label>
                                                                        <input type="checkbox" value="" name="" class="i-checks" />
                                                                        <span class="m-l-xs">Fair</span>
                                                                    </label>

                                                                </li>
                                                                <li class="cond">
                                                                    <label>
                                                                        <input type="checkbox" value="" name="" class="i-checks" />
                                                                        <span class="m-l-xs">Any</span>
                                                                    </label>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="display_books">
                        </div>

                    </div>
            </div>

        </div>

        <!-- Mainly scripts -->

        <script src="js/jquery-2.1.1.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

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

        <script>
            $(document).ready(function () {

                /////////////// filter //////////////////// 
                var price = "Any";
                var condition = "Any";

                function search_and_filter() {
                    $.ajax({
                        type: "POST",
                        url: './php/get_search_results.php',
                        dataType: 'json',
                        data: {
                            price: price,
                            condition: condition
                        },
                        success: function (data) {
                            if (!data.error) { // this sort of json accessing data only works in ajax
                                $('#numResults').html(data.numResults);
                                $('#display_books').html(data.books);

                            }
                        }
                    });
                }
                search_and_filter(); // call search on load of page
                ////////////////////

                $('.price label .i-checks').click(function () {
                    if ($(this).is(':checked')) {
                        var index = $('.price').index($(this).parent().parent());
                        uncheckOthers(index, 'price');

                        //this is the price u want to do stuff with
                        price = "Any";
                        var span;
                        if ((span = $(this).parent().find("span").text()) !== "Any") {
                            var nums = /[0-9]+$/;
                            price = parseInt(span.match(nums) + "");
                        }

                        //price is a number, either 5, 10, 20, 30, or Any
                        //DO STUFF HERE with price
                        search_and_filter();

                    }
                });

                $('.cond label .i-checks').click(function () {
                    if ($(this).is(':checked')) {
                        var index = $('.cond').index($(this).parent().parent());
                        uncheckOthers(index, 'cond');

                        //THIS IS THE CONDITION NAME, I.E. NEW, GOOD, FAIR, POOR
                        condition = $(this).parent().find("span").text();

                        //condition is a string, either New, Good, Fair, or Any
                        //DO STUFF HERE with condition
                        search_and_filter();
                    }
                });

                function uncheckOthers(index, name) {
                    var list = $('.todo-list').find('.' + name);
                    for (var i = 0; i < list.length; i++) {
                        if (i != index) {
                            $(list[i]).find('.i-checks').attr('checked', false);
                        }
                    }
                }
                var bookID; // used to store the book id for other functions on this page
                $(document).on('click', '.bought', function () { // document allows for dynamic content to use jquery
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

                            if (!data.error) { // for getting book details in modal
                                var seller = '<strong>Seller: </strong>' + data.seller;
                                var email = '<strong>Email: </strong>' + data.email;
                                var phone_num = '<strong>Phone: </strong>' + data.phone_num;
                                var pic = "<img src=\"" + data.pic + "\">";
                                var price = '$' + data.price;
                                var title = data.title + ' (' + data.publish_date + ')';
                                var authors = 'Author(s): ' + data.authors;
                                $('#seller').html(seller);
                                $('#email').html(email);
                                $('#phone_num').html(phone_num);
                                $('#pic').html(pic);
                                $('#productPrice').html(price);
                                $('#isbn').html(data.isbn);
                                $('#book_title').html(title);
                                $('#authors').html(authors);
                                $('#course_num').html(data.course_num);
                                $('#book_condition').html(data.book_condition);

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
                            if (!data.error) {
                                window.location.replace('./buy-confirm.php');

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
                $('.dropdown .space').focusout(function () {
                    $('#id').css("background-color", "black !important");
                });
                $('.dropdown .space').focus(function () {
                    $('#id').css("background-color", "black");
                });


            });
        </script>
    </body>

    </html>