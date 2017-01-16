<?php
//include './php/functions.php';
require_once("InfoController.class.php");
session_start();
if (isset($_POST['first_name'])){ // add users once they add their information in the create account modal
    
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $name = $first_name . ' ' . $last_name;
    $info = new InfoController($_SESSION['username']);
    $info->addUser($_SESSION['username'],$name,$_POST['phone_num'],$_POST['email']);
    header('Location: home.php');
}

?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Duke Book Exchange</title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/index.css" rel="stylesheet">
        <!-- Input Mask -->
        <link href="css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
    </head>

    <body class="top-navigation">
        <div id="aboutUs" class="modal inmodal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">About Us</h4>
                    </div>
                    <div class="modal-body">
                        Hey everyone. We built this website this past semester to make buying and selling books easier and cheaper for Duke students. Right now, we need your help to add books to this exchange so it can become useful for everyone when spring semester rolls around. If you have any books you want to sell, you can login with your net id at the top right and sell the book. Feel free to leave feedback at <a href='mailto:dukeexchange@gmail.com'>dukeexchange@gmail.com</a>. Thanks for the help!
                        <br>
                        <br> Sujay Garlanka and Bill Xiong

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="modal-form" class="modal fade" data-backdrop="static" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row" style="background-color: white">
                            <h3 class="m-t-none m-b">Create an Account</h3>
                            <div class="hr-line-dashed"></div>
                            <form role="form" method='post' action='index.php'>
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input name='first_name' type="text" placeholder="First Name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input name='last_name' type="text" placeholder="Last Name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input name='phone_num' type="text" class="form-control" data-mask="(999) 999-9999" placeholder="" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input id='email' name='email' type="email" placeholder="Enter email" class="form-control" required>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div>
                                    <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Log in</strong></button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>      <div id="modal-form" class="modal fade" data-backdrop="static" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row" style="background-color: white">
                            <h3 class="m-t-none m-b">Create an Account</h3>
                            <div class="hr-line-dashed"></div>
                            <form role="form" method='get' action='index.php'>
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input name='first_name' type="text" placeholder="First Name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input name='last_name' type="text" placeholder="Last Name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input name='phone_num' type="text" class="form-control" data-mask="(999) 999-9999" placeholder="" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input id='email' name='email' type="email" placeholder="Enter email" class="form-control" required>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div>
                                    <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Log in</strong></button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="wrapper">
            <div id="page-wrapper">
                <?php include 'logged_out_navbar.php'; ?>
                <div class="foobar">
                    <div>
                        <span>Duke Book Exchange</span>
                    </div>
                    <div class='small-message'>
                        <span>Sell and buy books. It's easy and free.</span>
                    </div>
                    <div class="vertical flip-container">
                        <div class="flipper">
                            <div class="front">
                                <button class="btn btn-xs btn-outline btn-success getting-started">Let's get started</button>
                            </div>
                            <div class="back">
                                <!--                                <div class="small-message" style="margin-bottom: -25px;">Search for a book- it's that easy.</div>-->
                                <div class="search-form animated fadeInDown">
                                    <form action="logged_out_search.php" method="post">
                                        <div class="input-group" style="font-weight: normal">
                                            <input type="text" name="search" class="form-control input-lg foc" autocomplete="off" placeholder="Search All, Class, Title, Author, or ISBN">
                                            <div class="input-group-btn">
                                                <button class="btn btn-lg btn-primary" type="submit">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <button type="button" class="btn btn-outline btn-default" data-toggle="modal" data-target="#aboutUs">About Us</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  <div class="foobar">
                    <div>
                        <span>Duke Book Exchange</span>
                    </div>
                    <div class='small-message' style="font-size: 23px;">
                        <span>Sell and buy books. It's easy and free.</span>
                    </div>
                    <div id="w">
                        <div id="page">
                            <div id="content-login">
                                <div class="content">
                                    <button class="btn btn-xs btn-outline btn-success getting-started" id="showregister">Let's get started</button>
                                    <form id="login" name="login" action="#" method="post">
                                    </form>
                                </div>
                            </div>


                            <div id="content-register">
                                <div class="content">
                                    <div class="search-form">
                                        <form action="logged_out_search.php" method="post">
                                            <div class="input-group" style="font-weight: normal">
                                                <input type="text" name="search" class="form-control input-lg foc" autocomplete="off">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-lg btn-primary" type="submit">
                                                        <i class="fa fa-search"></i>
                                                    </button>

                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div> -->

                <!-- <div class=col-md-4></div>             
                    <div class="col-md-4 data">
                            <div class="ibox-content">
                                    <div class=individual>
                                        <span>Current Temperature</span>
                                        <small class="pull-right">10/200 GB</small>
                                    </div>
                                    <div class=individual>
                                        <span>Conditions</span>
                                        <small class="pull-right">20 GB</small>
                                    </div>
                                    <div class=individual>
                                        <span>Feels Like</span>
                                        <small class="pull-right">73%</small>
                                    </div>
                                    <div class=individual>
                                        <span>Later Today</span>
                                        <small class="pull-right">400 GB</small>
                                    </div>
                            </div>
                        </div> -->

                <!-- <div class="search-form animated fadeInDown">
                    <form action="index.html" method="get">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control input-lg foc">
                            <div class="input-group-btn">
                                <button class="btn btn-lg btn-primary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div> -->
                <!--  <div class="footer">
                    <div class="about">
                        <strong>Copyright</strong> Duke Exchange &copy; 2016
                    </div>
                </div> -->

            </div>
        </div>



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

        <script src="js/formslider.js"></script>
        <?php
    
        if(isset($_SESSION['username'])){
            $info = new InfoController($_SESSION['username']);
            $user = $info->getUserInfo();
            if (count($user) == 0){

                $email = $_SESSION['username'] . '@duke.edu';
                echo "<script> $('#modal-form').modal('show'); $('#email').val('$email')</script>";

            }
            else {

                echo "<script> window.location.href = 'home.php'; </script>";

            }

        }
        
        
    
    ?>

            <script>
                $(document).ready(function () {
                    var width = $(window).width();
                    if ($(window).width() < 630) {
                        $('.foobar').css("font-size", "25px");
                        $('.footer').hide();
                        $('.small-message').css("font-size", "12px");
                    }
                    $(window).resize(function () {
                        if ($(window).width() < 630) {
                            $('.foobar').css("font-size", "25px");
                            $('.footer').hide();
                            $('.small-message').css("font-size", "12px");
                        } else {
                            $('.foobar').css("font-size", "70px");
                            $('.footer').show();
                            $('.small-message').css("font-size", "23px");
                        }
                    });
                });
            </script>

    </body>

    </html>
