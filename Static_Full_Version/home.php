<?php
//include "./php/functions.php";
//include_once "./model/AccountManager.class.php";
//include_once "./model/UserManager.class.php";
require_once("BookController.class.php");
require_once("InfoController.class.php");
require_once("NotificationController.class.php");
require_once("SearchController.class.php");
//include "./controller/BookController.class.php";
session_start();
if(!isset($_SESSION['username'])){
    header('Location: index.php');
}

error_reporting(E_ALL);
ini_set('display_errors', 1);
$_SESSION['book_controller'] = new BookController($_SESSION['username']);
$_SESSION['info_controller'] = new InfoController($_SESSION['username']);
$_SESSION['notif_controller'] = new NotificationController($_SESSION['username']);
$_SESSION['search_controller'] = new SearchController($_SESSION['username']);

$soldBooks = $_SESSION['book_controller']->getSoldBooks();
$boughtBooks = $_SESSION['book_controller']->getBoughtBooks();
$account = $_SESSION['info_controller']->getAccountOverview($boughtBooks, $soldBooks);
$user = $_SESSION['info_controller']->getUserInfo();
if (isset($_POST['name'])){
    $_SESSION['info_controller']->updateUserInfo($_POST['name'], $_POST['phone_num'], $_POST['email']);
    //updateUser($_SESSION['username'],$_POST['name'],$_POST['phone_num'],$_POST['email']);
    header('Location: home.php');
}
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Duke Exchange</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/home.css" rel="stylesheet">
        <!-- Customizes Navbar Breakpoint-->
        <link href="css/navbar.css" rel="stylesheet">
        <!-- Input Mask -->
        <link href="css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
    </head>

    <body class="top-navigation">
        <div id="update_info" class="modal fade" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row" style="background-color: white">
                            <h3 class="m-t-none m-b">Update Account</h3>
                            <div class="hr-line-dashed"></div>
                            <form role="form" method='post' action='home.php'>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input name='name' type="text" placeholder="Name" class="form-control" value="<?php echo $user->getName(); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input name='phone_num' type="text" class="form-control" data-mask="(999) 999-9999" placeholder="" value="<?php echo $user->getPhone(); ?>" >
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input id='email' name='email' type="email" placeholder="Enter email" class="form-control" value="<?php echo $user->getEmail(); ?>" required>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div>
                                    <button type="button" class="btn btn-sm btn-white m-t-n-xs" data-dismiss="modal">Close</button>
                                    <button class="btn btn-sm btn-success pull-right m-t-n-xs" type="submit"><strong>Update</strong></button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="wrapper">
            <div id="page-wrapper">
                <?php include 'navbar.php'; ?>

                    <!--
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-9">
                    <h2>Search Page</h2>
                </div>
            </div>
-->
                    <div class="title">
                        <h1>Welcome to Duke Book Exchange</h1>
                    </div>
                    <div class="wrapper wrapper-content animated fadeInRight expose">
                        <div class="row content">
                            <div class="col-lg-3">
                                <div class="widget ibox-content text-center">
                                    <h1><?php echo $user->getName(); ?></h1>
                                    <div class="m-b-sm">
                                        <i class="fa fa-user" style="font-size: 7em"></i>
                                        <!-- <img alt="image" class="img-circle" src="img/a8.jpg"> -->
                                    </div>
                                    <ul class="list-unstyled m-t-md">
                                        <li>
                                            <span class="fa fa-envelope m-r-xs"></span>
                                            <label>Email:</label>
                                            <?php echo $user->getEmail(); ?>
                                        </li>
                                        <li>
                                            <span class="fa fa-phone m-r-xs"></span>
                                            <label>Contact:</label>
                                            <?php echo $user->getPhone(); ?>
                                        </li>

                                        <li id='update' class="pull-right">
                                            <a class="btn btn-xs btn-white" data-toggle="modal" data-target="#update_info"><i class="fa fa-pencil-square"></i> Update Info</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-9">

                                <div class="widget p-lg ibox-content">
                                    <h2>
                                <span  style="color: #001A57;">Search</span>
                            </h2>
                                    <div>
                                        <div class="search-form">
                                            <form action="search.php" method="post">
                                                <div class="input-group">
                                                    <input type="text" placeholder="Search All, Class, Title, Author, or ISBN" name="search" class="form-control input-lg">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-lg btn-primary" type="submit">
                                                            <i class="fa fa-search"></i>
                                                        </button>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                    <?php //print_r($result); ?>


                                </div>

                            </div>

                            <div class="col-lg-3">
                                <div class="widget style1 bought-bg">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <i class="fa fa-dollar fa-5x"></i>
                                        </div>
                                        <div class="col-xs-8 text-right">
                                            <span> Total Made </span>
                                            <h2 class="font-bold" style="color: #001A57;"><?php echo $account['profit'];?></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="widget style1 bought-bg">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <i class="fa fa-book fa-5x"></i>
                                        </div>
                                        <div class="col-xs-8 text-right">
                                            <span> Books Sold </span>
                                            <h2 class="font-bold" style="color: #001A57;"><?php echo $account['books_sold'];?></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="widget style1 bought-bg">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <i class="fa fa-shopping-cart fa-5x"></i>
                                        </div>
                                        <div class="col-xs-8 text-right">
                                            <span> Books Bought</span>
                                            <h2 class="font-bold" style="color: #001A57;"><?php echo $account['books_bought'];?></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
            <?php include 'footer.php'; ?>
        </div>
        <!--         <div id="overlay"></div> -->

        <!-- Mainly scripts -->
        <script src="js/jquery-2.1.1.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

        <!-- Custom and plugin javascript -->
        <script src="js/inspinia.js"></script>
        <script src="js/plugins/pace/pace.min.js"></script>

        <!-- Input Mask-->
        <script src="js/plugins/jasny/jasny-bootstrap.min.js"></script>
        <script src="js/notifications.js"></script>
        <script>
            $(document).ready(function () {
                var width = $(window).width();
                if ($(window).width() < 360) {
                    $('.title h1').css("font-size", "20px");
                } else if ($(window).width() < 630) {
                    $('.title h1').css("font-size", "25px");
                }
                $(window).resize(function () {
                    if ($(window).width() < 360) {
                        $('.title h1').css("font-size", "20px");
                    } else if ($(window).width() < 630) {
                        $('.title h1').css("font-size", "25px");
                    } else {
                        $('.title h1').css("font-size", "45px");
                    }
                });
                /*$('.expose').click(function (e) {
                    $(this).css('z-index', '99999');
                    $('#overlay').fadeIn(300);
                });
                $('#overlay').click(function (e) {
                    $('#overlay').fadeOut(300, function () {
                        $('.expose').css('z-index', '1');
                    });
                });*/
            });
        </script>

    </body>

    </html>
