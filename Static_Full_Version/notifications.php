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

        <title>Notifications | Duke Exchange</title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <!-- FooTable -->
        <link href="css/plugins/footable/footable.core.css" rel="stylesheet">
        <link href="css/home.css" rel="stylesheet">
        <link href="css/notifications.css" rel="stylesheet">
        <!--                <link href="css/data.css" rel="stylesheet">-->

    </head>

    <body class="top-navigation">
        <div id="wrapper">
            <div id="page-wrapper">
                <?php include 'navbar.php'; ?>
                            <div class="row animated fadeInRight">
                <div class="col-lg-2" style="">&nbsp;</div>
                <div class="col-lg-8">
                <div class="ibox float-e-margins">
                    <div class="text-center float-e-margins p-md">
                    <h1  style="font-size: 45px;">Notifications</h1>
                    <a href="#" class="btn btn-xs btn-primary" id="leftVersion">Timeline View</a>
                    </div>
                    <div class="ibox-content" id="ibox-content">

                        <div id="vertical-timeline" class="vertical-container dark-timeline">

<!--                             <div class="vertical-timeline-block">
                                <div class="vertical-timeline-icon navy-bg">
                                    <i class="fa fa-briefcase"></i>
                                </div>

                                <div class="vertical-timeline-content">
                                    <h2>Meeting</h2>
                                    <p>Conference on the sales results for the previous year. Monica please examine sales trends in marketing and products. Below please find the current status of the sale.
                                    </p>
                                    <a href="#" class="btn btn-sm btn-primary"> More info</a>
                                    <span class="vertical-date">
                                        Today <br/>
                                        <small>Dec 24</small>
                                    </span>
                                </div>
                            </div> -->
                            <?php getNotificationArray($_SESSION['username']); ?>
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
                refresh = setInterval(function () {
                    refreshNotifications();

                }, 1000);

                $('.clear-notif').click(function(){
                 /*   console.log($('.vertical-timeline-block').index($(this).parent().parent()));
                    $(this).parent().parent().remove();*/
                });
                $('.clear-notif').click(function(){
                    $.ajax({
                    type: "POST",
                    url: "./php/removeNotifications.php",
                    data:  {'ind': 56},
                    }).done(function(msg) {
                    //alert( "Data Saved: " + msg );
                    });    
                });
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

            $('#leftVersion').click(function(event) {
                event.preventDefault()
                $('#vertical-timeline').toggleClass('center-orientation');
            });

                $('.footable').footable();
            });
        </script>

    </body>

    </html>