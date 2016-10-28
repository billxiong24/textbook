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
    <!--                <link href="css/data.css" rel="stylesheet">-->

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
                                <a aria-expanded="false" role="button" href="home.php"> Home</a>
                            </li>
                            <li>
                                <a aria-expanded="false" role="button" href="sell_integrated.php"> Sell</a>
                            </li>

                            <li>
                                <a aria-expanded="false" role="button" href="myAccount.php"> My Account</a>
                            </li>
                            <li class="dropdown">
                                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                Notifications
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
                                Log out
                                </a>
                            </li>

                        </ul>
                    </div>
                </nav>
            </div>

            <!--
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-9">
                    <h2>Search Page</h2>
                </div>
            </div>
-->
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="widget ibox-content text-center">
                            <h1>Nicki Smith</h1>
                            <div class="m-b-sm">
                                <img alt="image" class="img-circle" src="img/a8.jpg">
                            </div>
                            <ul class="list-unstyled m-t-md">
                                <li>
                                    <span class="fa fa-envelope m-r-xs"></span>
                                    <label>Email:</label>
                                    mike@mail.com
                                </li>
                                <li>
                                    <span class="fa fa-phone m-r-xs"></span>
                                    <label>Contact:</label>
                                    (+121) 678 3462
                                </li>
                                <li>

                                </li>
                            </ul>

                            <div class="text-center">
                                <a class="btn btn-xs btn-white"><i class="fa fa-thumbs-up"></i> Like </a>
                                <a class="btn btn-xs btn-primary"><i class="fa fa-heart"></i> Edit</a>
                            </div>
                        </div>
                    </div>
                    <!--
                    <div class="col-lg-3">
                        <div class="widget lazur-bg ">

                            <h2>
                                    Janet Smith
                                </h2>
                            <ul class="list-unstyled m-t-md">
                                <li>
                                    <span class="fa fa-envelope m-r-xs"></span>
                                    <label>Email:</label>
                                    mike@mail.com
                                </li>
                                <li>
                                    <span class="fa fa-phone m-r-xs"></span>
                                    <label>Contact:</label>
                                    (+121) 678 3462
                                </li>
                                 <li>
                                    
                                </li>
                            </ul>

                        </div>
                    </div>
-->
                    <div class="col-lg-9">

                        <div class="widget p-lg ibox-content">
                            <h2>
                                <span class="text-navy">Search</span>
                            </h2>

                            <div class="search-form">
                                <form action="search.php" method="post">
                                    <div class="input-group">
                                        <input type="text" placeholder="Admin Theme" name="search" class="form-control input-lg">
                                        <div class="input-group-btn">
                                            <button class="btn btn-lg btn-primary" type="submit">
                                                Search
                                            </button>
                                        </div>
                                    </div>

                                </form>
                            </div>

                            <?php //print_r($result); ?>


                        </div>

                    </div>

                    <div class="col-lg-3">
                        <div class="widget style1 navy-bg">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-cloud fa-5x"></i>
                                </div>
                                <div class="col-xs-8 text-right">
                                    <span> Today degrees </span>
                                    <h2 class="font-bold">26'C</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="widget style1 lazur-bg">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-envelope-o fa-5x"></i>
                                </div>
                                <div class="col-xs-8 text-right">
                                    <span> New messages </span>
                                    <h2 class="font-bold">260</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="widget style1 yellow-bg">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-music fa-5x"></i>
                                </div>
                                <div class="col-xs-8 text-right">
                                    <span> New albums </span>
                                    <h2 class="font-bold">12</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<!--
                <div class="row animated fadeInRight">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
-->
<!--
                            <div class="text-center float-e-margins p-md current-listings">
                                <span>Current Listing/Recent Activity: </span>
                                <a href="#" class="btn btn-xs btn-primary" id="leftVersion">Timeline View</a>
                            </div>
-->
<!--
                            <div class="widget ibox-content" id="ibox-content">

                                <div id="vertical-timeline" class="vertical-container dark-timeline">
                                    <div class="vertical-timeline-block">
                                        <div class="vertical-timeline-icon navy-bg">
                                            <i class="fa fa-briefcase"></i>
                                        </div>

                                        <div class="vertical-timeline-content">
                                            <h2>Selling</h2>
                                            <p>Conference on the sales results for the previous year. Monica please examine sales trends in marketing and products. Below please find the current status of the sale.
                                            </p>
                                            <a href="#" class="btn btn-sm btn-primary"> More info</a>
                                            <span class="vertical-date">
                                        Today <br/>
                                        <small>Dec 24</small>
                                    </span>
                                        </div>
                                    </div>

                                    <div class="vertical-timeline-block">
                                        <div class="vertical-timeline-icon blue-bg">
                                            <i class="fa fa-file-text"></i>
                                        </div>

                                        <div class="vertical-timeline-content">
                                            <h2>Selling</h2>
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since.</p>
                                            <a href="#" class="btn btn-sm btn-success"> Download document </a>
                                            <span class="vertical-date">
                                        Today <br/>
                                        <small>Dec 24</small>
                                    </span>
                                        </div>
                                    </div>

                                    <div class="vertical-timeline-block">
                                        <div class="vertical-timeline-icon lazur-bg">
                                            <i class="fa fa-coffee"></i>
                                        </div>

                                        <div class="vertical-timeline-content">
                                            <h2>Buying</h2>
                                            <p>Go to shop and find some products. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's. </p>
                                            <a href="#" class="btn btn-sm btn-info">Read more</a>
                                            <span class="vertical-date"> Yesterday <br/><small>Dec 23</small></span>
                                        </div>
                                    </div>

                                    <div class="vertical-timeline-block">
                                        <div class="vertical-timeline-icon yellow-bg">
                                            <i class="fa fa-phone"></i>
                                        </div>

                                        <div class="vertical-timeline-content">
                                            <h2>Buying</h2>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde? Iste voluptatibus minus veritatis qui ut.</p>
                                            <span class="vertical-date">Yesterday <br/><small>Dec 23</small></span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
-->
<!--
                <div class="row">
                    <div class="col-md-12">
                        <div class="ibox float-e-margins">
                            
                            <div class="widget ibox-title">
                                <h5>FooTable with row toggler, sorting and pagination</h5>

                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        <i class="fa fa-wrench"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-user">
                                        <li><a href="#">Config option 1</a>
                                        </li>
                                        <li><a href="#">Config option 2</a>
                                        </li>
                                    </ul>
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="widget ibox-content">

                                <table class="footable table table-stripped toggle-arrow-tiny">
                                    <thead>
                                        <tr>

                                            <th data-toggle="true">Project</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th data-hide="all">Company</th>
                                            <th data-hide="all">Completed</th>
                                            <th data-hide="all">Task</th>
                                            <th data-hide="all">Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Project - This is example of project</td>
                                            <td>Patrick Smith</td>
                                            <td>0800 051213</td>
                                            <td>Inceptos Hymenaeos Ltd</td>
                                            <td><span class="pie">0.52/1.561</span></td>
                                            <td>20%</td>
                                            <td>Jul 14, 2013</td>
                                            <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>Alpha project</td>
                                            <td>Alice Jackson</td>
                                            <td>0500 780909</td>
                                            <td>Nec Euismod In Company</td>
                                            <td><span class="pie">6,9</span></td>
                                            <td>40%</td>
                                            <td>Jul 16, 2013</td>
                                            <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>Betha project</td>
                                            <td>John Smith</td>
                                            <td>0800 1111</td>
                                            <td>Erat Volutpat</td>
                                            <td><span class="pie">3,1</span></td>
                                            <td>75%</td>
                                            <td>Jul 18, 2013</td>
                                            <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>Gamma project</td>
                                            <td>Anna Jordan</td>
                                            <td>(016977) 0648</td>
                                            <td>Tellus Ltd</td>
                                            <td><span class="pie">4,9</span></td>
                                            <td>18%</td>
                                            <td>Jul 22, 2013</td>
                                            <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                                        </tr>




                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5">
                                                <ul class="pagination pull-right"></ul>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
-->
                <!--
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="widget ibox-title">
                                <span class="label label-warning pull-right">Data has changed</span>
                                <h5>User activity</h5>
                            </div>
                            <div class="widget  ibox-content">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <small class="stats-label">Pages / Visit</small>
                                        <h4>236 321.80</h4>
                                    </div>

                                    <div class="col-xs-4">
                                        <small class="stats-label">% New Visits</small>
                                        <h4>46.11%</h4>
                                    </div>
                                    <div class="col-xs-4">
                                        <small class="stats-label">Last week</small>
                                        <h4>432.021</h4>
                                    </div>
                                </div>
                            </div>
                            <div class=" widget ibox-content">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <small class="stats-label">Pages / Visit</small>
                                        <h4>643 321.10</h4>
                                    </div>

                                    <div class="col-xs-4">
                                        <small class="stats-label">% New Visits</small>
                                        <h4>92.43%</h4>
                                    </div>
                                    <div class="col-xs-4">
                                        <small class="stats-label">Last week</small>
                                        <h4>564.554</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget ibox-content">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <small class="stats-label">Pages / Visit</small>
                                        <h4>436 547.20</h4>
                                    </div>

                                    <div class="col-xs-4">
                                        <small class="stats-label">% New Visits</small>
                                        <h4>150.23%</h4>
                                    </div>
                                    <div class="col-xs-4">
                                        <small class="stats-label">Last week</small>
                                        <h4>124.990</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
-->
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