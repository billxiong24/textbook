<?php
include "./php/functions.php";
session_start();
if(!isset($_SESSION['username'])){
    header('Location: index.php');
}
if (!isset($_SESSION['seller'])){ // seller information is passed via a session variable once a book is bought.
    header('Location: home.php');
}
else {
    $seller = getUser($_SESSION['seller']);
}
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Confirmation | Duke Exchange</title>

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
                <?php include 'navbar.php'; ?>

                    <!--
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-9">
                    <h2>Search Page</h2>
                </div>
            </div>
-->
                    <div class="title" style="text-align: center; margin-top: 100px">
                        <h3 style="font-weight: 400;">You have purchased a book! You can contact the seller, <?php echo $seller['name']; ?> at <?php echo $seller['phone_num']; ?> or <?php echo "<a href='mailto:{$seller['email']}'>{$seller['email']}</a>";?> to get the book or they will contact you.
                        <br/><br/>You can see the details of your purchase <a href="myAccount.php#purchase-history">here</a>.</h3>
                    </div>
                    <div class="wrapper wrapper-content animated fadeInRight expose">

                        <div class="ibox">
                            <div class="ibox-content">
                                <h3>Feedback</h3>

                                <p class="small">
                                    Any feedback on bugs, additional features or any reactions would greatly help!
                                </p>

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

                $('#send_feedback').submit(function (evt) {
                    evt.preventDefault(); // prevents the form from submitting on top of using this jquery function, so it doesn't send feedback twice
                    var postData = $(this).serialize(); // postData is POST data with the string name of form elements
                    var url = $(this).attr('action'); // in form html code as add_book.php
                    $.post(url, postData, function (data) {
                        window.location.replace('myAccount.php#purchase-history');
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