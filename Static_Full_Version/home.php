<?php
include "./php/functions.php";
session_start();
if(!isset($_SESSION['username'])){
    header('Location: index.php');
}
$account = accountOverview($_SESSION['username']);
$user = getUser($_SESSION['username']);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Account | Duke Exchange</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!-- FooTable -->
    <link href="css/plugins/footable/footable.core.css" rel="stylesheet">
     <link href="css/home.css" rel="stylesheet">
    <!--                <link href="css/data.css" rel="stylesheet">-->
    
</head>

<body class="top-navigation">
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
            <h1>Welcome to Duke Exchange</h1>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight expose">
                <div class="row content">
                    <div class="col-lg-3">
                        <div class="widget ibox-content text-center">
                            <h1><?php echo $user['name']; ?></h1>
                            <div class="m-b-sm">
                                <img alt="image" class="img-circle" src="img/a8.jpg">
                            </div>
                            <ul class="list-unstyled m-t-md">
                                <li>
                                    <span class="fa fa-envelope m-r-xs"></span>
                                    <label>Email:</label>
                                    <?php echo $user['email']; ?>
                                </li>
                                <li>
                                    <span class="fa fa-phone m-r-xs"></span>
                                    <label>Contact:</label>
                                    <?php echo $user['phone_num']; ?>
                                </li>
                                <li class="pull-right">
                                   <a class="btn btn-xs btn-white"><i class="fa fa-pencil-square"></i> Update </a>
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
                                <form action="search_results.php" method="post">
                                    <div class="input-group">
                                        <input type="text" placeholder="Search ISBN, Title, Author, or Class" name="search" class="form-control input-lg">
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
                                    <span> Total Profit </span>
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
                                    <h2 class="font-bold"  style="color: #001A57;"><?php echo $account['books_sold'];?></h2>
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
                                    <h2 class="font-bold"  style="color: #001A57;"><?php echo $account['books_bought'];?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
    <div id="overlay"></div>

    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- FooTable -->
    <script src="js/plugins/footable/footable.all.min.js"></script>


    <script>
        $(document).ready(function () {
            
            
            $('.footable').footable();
        $('.expose').click(function(e){
        $(this).css('z-index','99999');
        $('#overlay').fadeIn(300);
    });
    $('#overlay').click(function(e){
        $('#overlay').fadeOut(300, function(){
            $('.expose').css('z-index','1');
        });
    });
        });
    </script>

</body>

</html>