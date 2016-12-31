<?php
include "./php/functions.php";
session_start();

?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>About Us | Duke Exchange</title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/home.css" rel="stylesheet">
        <!-- Customizes Navbar Breakpoint-->
        <link href="css/navbar.css" rel="stylesheet">

    </head>

    <body class="top-navigation">
        <div id="wrapper">
            <div id="page-wrapper">

                <?php 
            if(!isset($_SESSION['username'])){
                include 'logged_out_navbar.php';
            }
            else {
                include 'navbar.php';
                
            }
             ?>
                    <div class="title col-lg-15">
                        <h1> About Us</h1></div>

                    <div class="wrapper wrapper-content animated fadeInRight">

                        <h2 class="text-center">Founders: Sujay Garlanka and Bill Xiong </h2>
                        <h2 class="text-center">Thanks to everyone who has sacrificed their time to test, give advice, and help in building this website, especially those below.</h2>
                        <h2 class="text-center">Harshil Garg | 2019 </h2>
                        <h2 class="text-center">Nipun Hewage | 2019 </h2>
                        <h2 class="text-center">Vishal Mummareddy | 2020 </h2>
                        <h2 class="text-center">Jack Myhre | 2019 </h2>
                        <h2 class="text-center">Mike Postiglione | 2019 </h2>
                        <h2 class="text-center">Matt Zehner |2019 </h2>







                    </div>

                    <?php include 'footer.php'; ?>

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


        <script>
            $(document).ready(function () {
                refresh = setInterval(function () {
                    refreshNotifications();

                }, 1000);


                function refreshNotifications() {
                    $.ajax({
                        url: './php/refreshNotifications.php',
                        dataType: "json",
                        success: function (data) {
                            if (!data.error) { // this sort of json accessing data only works in ajax
                                if (data.unread != 0) { // wont display notifications label if none exist
                                    $('#unreadNotifications').html(data.unread);
                                    $('#notifications').html(data.notifications);
                                } else {
                                    $('#unreadNotifications').html('');
                                    $('#notifications').html(data.notifications);
                                }



                            }
                        }
                    });
                }

                $('#readNotifications').click(function (evt) {
                    $(document).click(function () {
                        $.ajax({
                            url: './php/readNotifications.php',
                            success: function (data) {}
                        });


                    });

                });
            });
        </script>

    </body>

    </html>