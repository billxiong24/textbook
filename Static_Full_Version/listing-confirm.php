<?php
include "./php/functions.php";
session_start();
if(!isset($_SESSION['username'])){
    header('Location: index.php');
}
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Confirmation | Duke Exchange</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet">


        <link href="css/animate.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/home.css" rel="stylesheet">

    </head>

    <body class='top-navigation'>
        <div id="wrapper">
            <div id="page-wrapper">
                <?php include 'navbar.php'; ?>
                    <div class="title" style="text-align: center; margin-top: 100px">
                        <h3 style="font-weight: 400;">Congratulations! You have posted your item on the market place.<br/> <br/>We'll notify you when your item is sold. You can click<a href="myAccount.php#listings"> here</a> to see the details.</h3>
                    </div>
                    <div class="wrapper wrapper-content animated fadeInRight expose">
                        <form id='send_feedback' role="form" method='post' action='./php/send_feedback.php'>
                            <div class="form-group">
                                <label>Subject</label>
                                <input name='subject' type="text" class="form-control" placeholder="Feedback subject" required>
                            </div>
                            <div class="form-group">
                                <label>Feedback</label>
                                <textarea name='feedback' class="form-control" placeholder="Your message" rows="3" required></textarea>
                            </div>
                            <input type="submit" value="Submit" class="btn btn-success btn-block btn-outline">
                        </form>

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
        <!-- <script src="js/plugins/pace/pace.min.js"></script> -->

        <!-- jQuery UI -->
        <script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>

        <script>
            $(document).ready(function () {
                refresh = setInterval(function () {
                    refreshNotifications();

                }, 1000);


                $('#send_feedback').submit(function (evt) {
                    evt.preventDefault(); // prevents the form from submitting on top of using this jquery function, so it doesn't send feedback twice
                    var postData = $(this).serialize(); // postData is POST data with the string name of form elements
                    var url = $(this).attr('action'); // in form html code as add_book.php
                    $.post(url, postData, function (data) {
                        window.location.replace('myAccount.php#listings');
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


            });
        </script>
    </body>

    </html>