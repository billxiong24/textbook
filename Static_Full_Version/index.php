<?php
include './php/functions.php';
session_start();

if (isset($_POST['first_name'])){ // add users once they add their information in the create account modal
    
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $name = $first_name . ' ' . $last_name;
    addUser($_SESSION['username'],$name,$_POST['phone_num'],$_POST['email']);
    header('Location: home.php');
}



?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Duke Exchange</title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/index.css" rel="stylesheet">
        <!-- Input Mask -->
        <link href="css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
    </head>

    <body class="top-navigation">
        <div id="modal-form" class="modal fade" data-backdrop="static" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <h3 class="m-t-none m-b">Create an Account</h3>
                            <div class="hr-line-dashed"></div>
                            <form role="form" method='post' action='index.php' >
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input name = 'first_name' type="text" placeholder="First Name" class="form-control" required>
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
                <div class="row">
                    <nav class="navbar navbar-static-top" role="navigation">
                        <div class="navbar-header">
                            <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                                <i class="fa fa-reorder"></i>
                            </button>
                            <span>
                        <a href="#" class="navbar-brand">Duke 
                        <span class="smaller">EXCHANGE</span></a>
                            </span>
                        </div>
                        <div class="navbar-collapse collapse" id="navbar">
                            <ul class="nav navbar-nav navbar-right">
                                <!--  <li>
                                <a aria-expanded="false" role="button" href="index2.html"> Home</a>
                            </li>
                            <li>
                                <a aria-expanded="false" role="button" href="dashboard_4_sell.php"> Sell</a>
                            </li>
                            <li>
                                <a aria-expanded="false" role="button" href="data.html"> My Account</a>
                            </li> -->
                                <li>
                                    <a aria-expanded="false" role="button" href="auth.html"> Sign up</a>
                                </li>
                                <li>
                                    <a href="oauth.php">
                                Log in
                                </a>
                                </li>

                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="foobar">
                    <span>Duke Exchange</span>
                </div>

                <div class="search-form animated fadeInDown">
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
                </div>
                <div class="footer">
                    <div class="pull-right about">
                        About us
                    </div>
                    <div class="about">
                        <strong>Copyright</strong> Duke Exchange &copy; 2016
                    </div>
                </div>

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

        <?php
    
        if(isset($_SESSION['username'])){
            $user = getUser($_SESSION['username']);
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
                        $('.foobar').css("font-size", "30px");
                        $('.footer').hide();
                    }
                    $(window).resize(function () {
                        if ($(window).width() < 630) {
                            $('.foobar').css("font-size", "30px");
                            $('.footer').hide();
                        } else {
                            $('.foobar').css("font-size", "70px");
                            $('.footer').show();
                        }
                    });
                });
            </script>

    </body>

    </html>