<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>How It Works | Duke Exchange</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/home.css" rel="stylesheet">

</head>

<body class="top-navigation">
    <div id="wrapper">
        <div id="page-wrapper">
            <?php include 'logged_out_navbar.php'; ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="wrapper wrapper-content animated fadeInRight">

                            <div class="ibox-content m-b-sm border-bottom">
                                <div class="p-xs">
                                    <div class="pull-left m-r-md">
                                        <i class="fa fa-question text-success mid-icon"></i>
                                    </div>
                                    <h2>How It Works</h2>
                                    <span>Hopefully this page can answer any questions you have! Email <a href='mailto:dukeexchange@gmail.com'>dukeexchange@gmail.com</a> if you have more questions. <b>Right now, we need your help to add books to this exchange so it can become useful for everyone when spring semester rolls around.</b></span>
                                </div>
                            </div>


                            <div class="ibox-content forum-container">

                                <div class="forum-item">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="forum-icon">
                                                <i class="fa fa-shield"></i>
                                            </div>
                                            <a href="#" class="forum-item-title">Purpose</a>
                                            <div class="forum-sub-title">The goal of this book exchange is to make it easier for Duke students to buy and sell books for less money. This is completely free because we built it for Duke students like us. We hope it helps! </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="forum-item">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="forum-icon">
                                                <i class="fa fa-cogs"></i>
                                            </div>
                                            <a href="#" class="forum-item-title">How It Works</a>
                                            <div class="forum-sub-title">Students can <a href='logged_out_redirect.php'>sell</a> their book by adding it to the exchange with a short step by step form that uses google to help find your book and has classes preloaded. Buyers can <a href='logged_out_redirect.php'>buy</a> a book by searching the exchange for available books. Buying is easier because books are added with course numbers and ISBN's, making it easier to search. Also, books are removed once they are bought, leaving only available books. Once a book is bought, both the seller and buyer are sent an email with each others contact information, so they can meet up to pay for and exchange the book. All transactions are also recorded in the <a href='logged_out_redirect.php'>My Account</a> page when logged in. <b>As of now, payment does not take place on this site to ensure people can check a book before they pay for it.</b></div>
                                        </div>

                                    </div>
                                </div>

                                <div class="forum-item">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="forum-icon">
                                                <i class="fa fa-tag"></i>
                                            </div>
                                            <a href="#" class="forum-item-title">Sell</a>
                                            <div class="forum-sub-title">Click on the <a href='logged_out_redirect.php'>sell</a> tab to add a book to the exchange. You just need to follow the steps on the page to a sell a book. Once someone buys your book, you will get an email with the buyer's information. Afterwards, you can contact them to arrange a time and place to meet to sell the book. Books you are currently selling will show up under <a href='logged_out_redirect.php'>Current Listings</a>. Once they are sold, the book's and seller's information will show up under <a href='logged_out_redirect.php'>Sell History</a>. </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="forum-item">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="forum-icon">
                                                <i class="fa fa-shopping-bag"></i>
                                            </div>
                                            <a href="#" class="forum-item-title">Buy</a>
                                            <div class="forum-sub-title">Click on the buy tab to buy a book. You can search for a book by class, course number, title, author and ISBN. If someone is selling the book, it will show up and you can buy it. Afterwards, you will get the seller's information on the website under <a href='logged_out_redirect.php'>Purchase History</a> and via email. You can then contact the seller to arrange a time and place to meet to buy the book.</div>
                                        </div>

                                    </div>
                                </div>

                            </div>

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