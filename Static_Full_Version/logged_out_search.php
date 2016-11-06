<?php
include "./php/functions.php";

if (isset($_GET['search'])){
    $result = log_out_search($_GET['search']);
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

        <title><?php echo $_GET['search'] ?> - Duke Exchange</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

        <!-- Toastr style -->
        <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">

        <!-- Gritter -->
        <link href="js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

        <link href="css/animate.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/home.css" rel="stylesheet">
        <link href="css/search_results.css" rel="stylesheet">

    </head>

    <body class='top-navigation'>
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
                                    <a href="oauth.php">
                                        <i class="fa fa-sign-in" aria-hidden="true"></i>Log in
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
                                <?php echo count($result); ?> results found for: <span style="color: #001A57"><?php echo $_GET['search']; ?></span>
                            </h2>

                                    <div class="search-form">
                                        <form action="logged_out_search.php" method="get">
                                            <div class="input-group">
                                                <input type="text" placeholder="Search ISBN, Title, Author, or Class" name="search" class="form-control input-lg">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-lg btn-primary space" type="submit">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                    <!--  <li class="dropdown" style="display: inline; margin-left: 5px;">
                    <a class="dropdown-toggle count-info btn btn-lg btn-primary space" data-toggle="dropdown" href="#">
                                                        <i class="fa fa-filter"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts pull-right todo-list m-t" style=" margin-top: 20px;  width: 250px; padding-top: 5px;">
                        <span class=labels>Price: </span> 
                        <li>
                        <label>
                            <input type="checkbox" value="" name="" class="i-checks"/>
                            <span class="m-l-xs">Under $5</span>
                        </label>
                        </li>
                        <li>
                        <label>
                            <input type="checkbox" value="" name="" class="i-checks"/>
                            <span class="m-l-xs">Under $10</span>
                        </label>
                        </li>
                        <li>
                        <label>
                            <input type="checkbox" value="" name="" class="i-checks" />
                            <span class="m-l-xs">Under $20</span>
                        </label>    
                        </li>
                        <li>
                           <label>
                            <input type="checkbox" value="" name="" class="i-checks" />
                            <span class="m-l-xs">Under $30</span>
                        </label>  
                            
                        </li>
                        <li>
                            <label>
                            <input type="checkbox" value="" name="" class="i-checks" />
                            <span class="m-l-xs">Any</span>
                        </label>  
                            
                        </li>
                        <span class=labels>Condition:</span> 
                        <li>
                            <label>
                            <input type="checkbox" value="" name="" class="i-checks" />
                            <span class="m-l-xs">New</span>
                        </label>  
                            
                        </li>
                        <li>
                          <label>
                            <input type="checkbox" value="" name="" class="i-checks" />
                            <span class="m-l-xs">Good</span>
                        </label>  
                        </li>
                        <li>
                           <label>
                            <input type="checkbox" value="" name="" class="i-checks" />
                            <span class="m-l-xs">Fair</span>
                        </label>  
                            
                        </li>
                        <li>
                           <label>
                            <input type="checkbox" value="" name="" class="i-checks" />
                            <span class="m-l-xs">Any</span>
                        </label>  
                        </li>
                    </ul>
                </li> -->
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
                            
                            echo "<img style='max-height: 135px;' src=\"{$result[$i]['cover_url']}\">";
                                
                            echo '</div>
                            <div class="product-desc">
                                <span class="product-price">';
                                 echo '$'.$result[$i]['price'];
                                echo '</span>
                                <small class="text-muted">'; echo $result[$i]['isbn']; echo '</small>
                                <a href="#" class="product-name">'; 
                                $str = $result[$i]['title'];
                                if(strlen($str) > 25){
                                    $cut = substr($str, 0, 25). "...";
                                    echo $cut;
                                }
                                else{
                                    echo $str;
                                }
                                 

                                echo '</a>
                                <div class="small m-t-xs">';
                                    echo 'Author(s): ';
                                    $authors = $result[$i]['authors'];
                                    if(strlen($authors) > 20){
                                        echo substr($authors, 0, 20) . "...";
                                    }
                                    else{
                                        echo $authors;
                                    }
                                echo '</div>
                                <div class="small m-t-xs">
                                <p><span class="label label-success">'; echo $result[$i]['course_num']; echo '</span> 
                                <span class="label label-danger">'; echo $result[$i]['book_condition'];
                                echo '</span></p>
                                </div>';
                
                                echo'
                                <div class="m-t text-right buy">
                                    <button href="#" data-id ='; echo "\"{$result[$i]['id']}\""; echo 'class="btn btn-xs btn-outline btn-success bought">Buy <i class="fa fa-long-arrow-right"></i> </button>
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
        <!--<script src="js/frontpage.js">-->
        </script>

        <script>
            $(document).ready(function () {
                $('.bought').click(function(){
                    window.location.replace('logged_out_redirect.php');
                });

            });
        </script>
    </body>

    </html>