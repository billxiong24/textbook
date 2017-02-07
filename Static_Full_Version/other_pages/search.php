<?php
include "./php/functions.php";
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

        <title>INSPINIA | Search Page</title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

        <link href="css/animate.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">

    </head>

    <body>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-9">
                <h2>Search Page</h2>
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <h2>
                                2,160 results found for: <span class="text-navy">“Admin Theme”</span>
                            </h2>
                            <small>Request time  (0.23 seconds)</small>

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
                                    echo 'Authors: '.$result[$i]['authors'];
                                echo '</div>
                                <div class="small m-t-xs">
                                <p><span class="label label-success">'; echo $result[$i]['course_num']; echo '</span> 
                                <span class="label label-danger">'; echo $result[$i]['book_condition'];
                                echo '</span></p>
                                </div>';
                
                                echo'
                                <div class="m-t text-right">
                                    <a href="#" class="btn btn-xs btn-outline btn-primary">Buy <i class="fa fa-long-arrow-right"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
                
                
                
            }
            echo '</div>';
            ?>



        </div>


        <!-- Mainly scripts -->
        <script src="js/jquery-2.1.1.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

        <!-- Custom and plugin javascript -->
        <script src="js/inspinia.js"></script>
        <script src="js/plugins/pace/pace.min.js"></script>


    </body>

    </html>