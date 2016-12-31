<?php
include "./php/functions.php";
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Duke Exchange</title>
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
                <?php include 'logged_out_navbar.php'; ?>
                    <div class="title" style="text-align: center; margin-top: 100px">
                        <h3 style="font-weight: 400;">You must <a href="oauth.php">log in</a> to buy or sell.</h3>
                    </div>
                    <div class="wrapper wrapper-content animated fadeInRight expose">
                        <div class="row content">

                        </div>
                    </div>
                    <?php include 'footer.php'; ?>

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
        <!--        </script>-->

        <script>
            $(document).ready(function () {


            });
        </script>
    </body>

    </html>