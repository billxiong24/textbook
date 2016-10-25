<?php
include "./php/functions.php";
session_start();
$soldBooks = soldBooks($_SESSION['username']);
$boughtBooks = boughtBooks($_SESSION['username']);
$account = accountOverview($_SESSION['username']);

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
        <link href="css/data.css" rel="stylesheet">

        <!-- FooTable -->
        <link href="css/plugins/footable/footable.core.css" rel="stylesheet">
    </head>

    <body class="top-navigation">
        <div id="wrapper">
            <div id="page-wrapper">
                <div class="row">
                    <nav class="navbar navbar-static-top" role="navigation">
                        <div class="navbar-header">
                            <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                                <i class="fa fa-reorder"></i>
                            </button>
                            <a href="home.php" class="navbar-brand">Duke 
                        <span class="smaller">EXCHANGE</span></a>
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
                                <li class="dropdown">
                                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <i class="fa fa-bell-o" aria-hidden="true"></i>Notifications
                            </a>
                                    <ul class="dropdown-menu dropdown-alerts" style="width: 300%">
                                        <li>
                                            <a href="mailbox.html">
                                                <div>
                                                    <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="profile.html">
                                                <div>
                                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="grid_options.html">
                                                <div>
                                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <div class="text-center link-block">
                                                <a href="notifications.html">
                                                    <strong>See all Notifications</strong>
                                                    <i class="fa fa-angle-right"></i>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="auth.html">
                                <i class="fa fa-sign-out" aria-hidden="true"></i>Log out
                                </a>
                                </li>

                            </ul>
                        </div>
                    </nav>
                </div>
                <div id="page-wrapper">
                    <div class="title col-lg-15"><span>Account History</span></div>
                    <div class="wrapper wrapper-content ecommerce">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5>Profit</h5>
                                    </div>
                                    <div class="ibox-content">
                                        <h1 class="no-margins">
                                            <?php if($account['profit'] < 0){
                                                echo '-$'.abs($account['profit']);   
                                            }
                                            else{
                                                echo '$'.$account['profit'];
                                            }
                                            ?></h1>
                                        <div class="font-bold text-success">Total Profit</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5>Sold</h5>
                                    </div>
                                    <div class="ibox-content">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <h1 class="no-margins">$<?php echo $account['books_sold'];?></h1>
                                                <div class="font-bold text-navy">Amount Sold</div>
                                            </div>
                                            <div class="col-md-6">
                                                <h1 class="no-margins"><?php echo $account['money_made'];?></h1>
                                                <div class="font-bold text-navy">Number Sold</div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5>Bought</h5>
                                    </div>
                                    <div class="ibox-content">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <h1 class="no-margins">$<?php echo $account['spent'];?></h1>
                                                <div class="font-bold text-navy">Amount Bought</div>
                                            </div>
                                            <div class="col-md-6">
                                                <h1 class="no-margins"><?php echo $account['books_bought'];?></h1>
                                                <div class="font-bold text-navy">Number Bought</div>
                                            </div>
                                        </div>


                                    </div>

                                </div>
                            </div>




                            <!--
                            <div class="col-lg-15">
                                <div class="col-lg-8 purchase">AT A GLANCE</div>
                                
                                
                                <div class="ibox">
                                    <div class="ibox-content">

                                        <table class="footable table table-stripped toggle-arrow-tiny">
                                            <thead>
                                                <tr>

                                                    <th data-toggle="true" data-sort-ignore="true"></th>

                                                        <th data-hide="phone,tablet" >Quantity</th> 
                                                    <th data-sort-ignore="true"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        Books Bought
                                                    </td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>
                                                        <span class="label label-warning pull-right"><?php //echo $account['books_bought'];?></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Total Spent
                                                    </td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>
                                                        <span class="label label-warning pull-right">$<?php //echo $account['spent'];?></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Books Sold
                                                    </td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>
                                                        <span class="label label-danger pull-right"><?php //echo //$account['books_sold'];?></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Total Made
                                                    </td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>
                                                        <span class="label label-danger pull-right">$<?php //echo $account['money_made'];?></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Profit
                                                    </td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>
                                                        <span class="label label-success pull-right">$<?php //echo $account['profit'];?></span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
-->
                        </div>
                        <div class="row">
                            <div class="purchase col-lg-2"></div>
                            <div class="col-lg-12">
                                <div class="col-lg-8 purchase">SELL HISTORY</div>
                                <div class="ibox">
                                    <div class="ibox-content">

                                        <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                                            <thead>
                                                <tr>

                                                    <th data-toggle="true">Title</th>
                                                    <th data-hide="phone" data-sort-ignore="true">ISBN</th>
                                                    <th data-hide="phone" data-sort-ignore="true">Course</th>
                                                    <th>Price</th>
                                                    <th class="text-right">Transaction Date</th>
                                                    <th data-hide="all">Book Condition</th>
                                                    <th data-hide="all">Notes</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                            echo "<tr>";
                                            foreach ($soldBooks as $book){
                                                echo "<td> {$book['title']}</td>";
                                                echo "<td> {$book['isbn']}</td>";
                                                echo "<td> <span class='label label-success'>{$book['course_num']}</span></td>";
                                                echo "<td>$ {$book['price']}.00</td>";
                                                $date = date("m/d/y",$book['trans_date']);
                                                echo "<td class='text-right'> {$date}</td>";
                                                echo "<td> {$book['book_condition']}</td>";
                                                echo "<td> {$book['notes']}</td>";
                                                
                                            }
                                            echo "</tr>";
                                            
                                            
                                            ?>

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="6">
                                                        <ul class="pagination pull-right"></ul>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="purchase col-lg-2" style="margin-top: 5px;"></div>

                            <div class="col-lg-12">
                                <div class="col-lg-8 purchase">PURCHASE HISTORY</div>
                                <div class="ibox tab">
                                    <div class="ibox-content">

                                        <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                                            <thead>
                                                <tr>

                                                    <th data-toggle="true">Title</th>
                                                    <th data-hide="phone" data-sort-ignore="true">ISBN</th>
                                                    <th data-hide="phone" data-sort-ignore="true">Course</th>
                                                    <th>Price</th>
                                                    <th class="text-right">Transaction Date</th>
                                                    <th data-hide="all">Book Condition</th>
                                                    <th data-hide="all">Notes</th>
                                                    <th data-hide="all">Seller Name</th>
                                                    <th data-hide="all">Seller Email</th>
                                                    <th data-hide="all">Seller Phone</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                            
                                            foreach ($boughtBooks as $book){
                                                echo "<tr>";
                                                echo "<td> {$book['title']}</td>";
                                                echo "<td> {$book['isbn']}</td>";
                                                echo "<td> <span class='label label-success'>{$book['course_num']}</span></td>";
                                                echo "<td>$ {$book['price']}.00</td>";
                                                $date = date("m/d/y",$book['trans_date']);
                                                echo "<td class='text-right'> {$date}</td>";
                                                echo "<td> {$book['book_condition']}</td>";
                                                echo "<td> {$book['notes']}</td>";
                                                $seller = getUser($book['seller']);
                                                echo "<td> {$seller['name']}</td>";
                                                echo "<td> {$seller['email']}</td>";
                                                echo "<td> {$seller['phone_num']}</td>";
                                                echo "</tr>";
                                            }
                                            
                                            
                                            
                                            ?>

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="6">
                                                        <ul class="pagination pull-right"></ul>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
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

        <!-- FooTable -->
        <script src="js/plugins/footable/footable.all.min.js"></script>


        <script>
            $(document).ready(function () {

                $('.footable').footable();
            });
        </script>

    </body>

    </html>