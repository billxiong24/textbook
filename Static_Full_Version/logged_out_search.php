<?php
//include './php/functions.php';
session_start();

if (isset($_GET['search'])){
    $_SESSION['search'] = $_GET['search'];
}
else {
    header("Location: index.php");
}
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8"> <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>
            <?php echo $_GET['search'] ?> - Duke Exchange</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/home.css" rel="stylesheet">
        <link href="css/search.css" rel="stylesheet">

    </head>

    <body class='top-navigation'>
        <div id="wrapper">
            <div id="page-wrapper">
                <?php include 'logged_out_navbar.php'; ?>
                    <!-- <div class="recommend rec-message">
            <span>Search Results for "Some search"</span>
        </div> -->
                    <div class="wrapper wrapper-content animated fadeInRight">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-content">
                                        <h2>
                                <span id="numResults"></span><span style="color: #001A57"><?php echo $_POST['search']; ?></span>
                            </h2>

                                        <div class="search-form">
                                            <form action="logged_out_search.php" method="post">
                                                <div class="input-group">
                                                    <input type="text" placeholder="Search All, ISBN, Title, Author, or Class" name="search" class="form-control input-lg">
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
                                                                        <input type="checkbox" value="" name="" class="i-checks" checked/>
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
                                                                        <span class="m-l-xs">Almost New</span>
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
                                                                        <span class="m-l-xs">UNC Crapple Hill</span>
                                                                    </label>
                                                                </li>
                                                                <li class="cond">
                                                                    <label>
                                                                        <input type="checkbox" value="" name="" class="i-checks" checked/>
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
            <?php include 'footer.php'; ?>
        </div>

        <!-- Mainly scripts -->

        <script src="js/jquery-2.1.1.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

        <!-- Custom and plugin javascript -->
        <script src="js/inspinia.js"></script>
        <script src="js/plugins/pace/pace.min.js"></script>

        <!-- jQuery UI -->
        <script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>


        <script>
            $(document).ready(function () {
                $(document).on('click', '.bought', function () { // document allows for dynamic content to use jquery
                    window.location.replace('logged_out_redirect.php');

                });

                /////////////// filter //////////////////// 
                var price = "Any";
                var condition = "Any";

                function search_and_filter() {
                    $.ajax({
                        type: "GET",
                        url: './php/get_search_results.php',
                        dataType: 'json',
                        data: {
                            price: price,
                            condition: condition
                        },
                        success: function (data) {
                            if (!data.error) { // this sort of json accessing data only works in ajax
                                if (data.numResults == 0) {
                                    $('#numResults').html('No one currently selling books for: ');
                                } else {
                                    $('#numResults').html(data.numResults + ' results found for: ');
                                }
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
            });
        </script>
    </body>

    </html>
