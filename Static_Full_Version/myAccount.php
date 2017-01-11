<?php
include "./php/functions.php";
include "./model/AccountManager.class.php";
require_once('./controller/BookController.class.php');
require_once("./controller/InfoController.class.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
if(!isset($_SESSION['username'])){
    header('Location: index.php');
}

$currentListings = $_SESSION['book_controller']->getCurrentListings();
$soldBooks = $_SESSION['book_controller']->getSoldBooks();
$boughtBooks = $_SESSION['book_controller']->getBoughtBooks();
$account = $_SESSION['info_controller']->getAccountOverview($boughtBooks, $soldBooks);
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
        <link href="css/myAccount.css" rel="stylesheet">
        <link href="css/home.css" rel="stylesheet">
        <!-- Customizes Navbar Breakpoint-->
        <link href="css/navbar.css" rel="stylesheet">

        <!-- FooTable -->
        <link href="css/plugins/footable/footable.core.css" rel="stylesheet">
        <style>
            .fakeLink {
                /* Both fakelinks are for the titles on the myAccount page so people know to click on them for more details */
                color: #427eb7;
            }
            
            .fakeLink:hover {
                color: #23527c;
            }
        </style>
    </head>

    <body class="top-navigation">
        <div id="removeListingModal" class="modal inmodal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Remove Listing</h4>
                    </div>
                    <div class="modal-body text-center">
                        Are you sure you would like to remove the following book from the marketplace?
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button id="removeListing" type="button" class="btn btn-white buy-modal-button">Remove</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="removePurchaseModal" class="modal inmodal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Cancel Purchase</h4>
                    </div>
                    <div class="modal-body text-center">
                        Are you sure you would like to cancel the following purchase?
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button id="cancelPurchase" type="button" class="btn btn-white buy-modal-button">Yes</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="wrapper">
            <div id="page-wrapper">
                <?php include 'navbar.php' ?>
                    <div class="title col-lg-15">
                        <h1> Account History</h1></div>
                    <div class="wrapper wrapper-content ecommerce animated fadeInRight">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5>Made</h5>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h1 class="no-margins">
                                            <?php if($account['profit'] < 0){
                                                echo '-$'.abs($account['profit']);   
                                            }
                                            else{
                                                echo '$'.$account['profit'];
                                            }
                                            ?></h1>
                                                <div class="font-bold text-success">Total Made</div>
                                            </div>
                                        </div>
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
                                                <h1 class="no-margins">$<?php echo $account['money_made'];?></h1>
                                                <div class="font-bold text-success">Amount Sold</div>
                                            </div>
                                            <div class="col-md-6">
                                                <h1 class="no-margins"><?php echo $account['books_sold'];?></h1>
                                                <div class="font-bold text-success">Number Sold</div>
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
                                                <div class="font-bold text-success">Amount Bought</div>
                                            </div>
                                            <div class="col-md-6">
                                                <h1 class="no-margins"><?php echo $account['books_bought'];?></h1>
                                                <div class="font-bold text-success">Number Bought</div>
                                            </div>
                                        </div>


                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="purchase col-lg-2"></div>
                            <div class="col-lg-12">
                                <a class="col-lg-8 purchase" name="listings" href="#listings">
                                    <div class="col-lg-8 purchase">CURRENT LISTINGS</div>
                                </a>
                                <div class="ibox">
                                    <div class="ibox-content">

                                        <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                                            <thead>
                                                <tr>

                                                    <th data-toggle="true">Title</th>
                                                    <th data-hide="phone" data-sort-ignore="true">ISBN</th>
                                                    <th data-hide="phone" data-sort-ignore="true">Course</th>
                                                    <th>Price</th>
                                                    <th data-sort-ignore="true" class="text-right">Remove</th>
                                                    <th data-hide="all">Author(s)</th>
                                                    <th data-hide="all">Book Condition</th>
                                                    <th data-hide="all">Notes</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                            
                                            foreach ($currentListings as $listing){
                                                echo "<tr>";
                                                echo "<td class='fakeLink'> {$listing['title']}</td>";
                                                echo "<td> {$listing['isbn']}</td>";
                                                echo "<td> <span class='label label-warning'>{$listing['course_num']}</span></td>";
                                                echo "<td>".'$'."{$listing['price']}.00</td>";
                                                echo "<td class='text-right'><i data-id='{$listing['id']}' data-toggle='modal' data-target='#removeListingModal' class='fa fa-trash text-danger delete_listing'></i></td>";
                                                echo "<td> {$listing['authors']}</td>";
                                                echo "<td> {$listing['book_condition']}</td>";
                                                echo "<td> {$listing['notes']}</td>";
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
                        <div class="row">
                            <div class="purchase col-lg-2" style="margin-top: 5px;"></div>

                            <div class="col-lg-12">
                                <a name="purchase-history" href="#purchase-history">
                                    <div class="col-lg-8 purchase">PURCHASE HISTORY</div>
                                </a>
                                <div class="ibox tab">
                                    <div class="ibox-content">

                                        <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                                            <thead>
                                                <tr>

                                                    <th data-toggle="true">Title</th>
                                                    <th data-hide="phone" data-sort-ignore="true">ISBN</th>
                                                    <th data-hide="phone" data-sort-ignore="true">Course</th>
                                                    <th>Price</th>
                                                    <th data-hide="phone,tablet"class="text-right">Transaction Date</th>
                                                    <th data-sort-ignore="true" class="text-right">Cancel</th>
                                                    <th data-hide="all">Author(s)</th>
                                                    <th data-hide="all">Book Condition</th>
                                                    <th data-hide="all">Notes</th>
                                                    <th data-hide="all">Seller Name</th>
                                                    <th data-hide="all">Seller Email</th>
                                                    <th data-hide="all">Seller Phone</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                            
                                            foreach ($boughtBooks as $trans){
                                                echo "<tr>";
                                                echo "<td class='fakeLink'> {$trans->getBook()->getTitle()}</td>";
                                                echo "<td> {$trans->getBook()->getIsbn()}</td>";
                                                echo "<td> <span class='label label-warning'>{$trans->getBook()->getCourseNum()}</span></td>";
                                                echo "<td>".'$'."{$trans->getBook()->getPrice()}.00</td>";
                                                $date = date("m/d/y",$trans->getTransDate());
                                                echo "<td class='text-right'> {$date}</td>";
                                                echo "<td class='text-right'><i data-id='{$trans->getBook()->getID()}' data-toggle='modal' data-target='#removePurchaseModal' class='fa fa-trash text-danger delete_purchase'></i></td>";
                                                echo "<td> {$trans->getBook()->getAuthors()}</td>";
                                                echo "<td> {$trans->getBook()->getCondition()}</td>";
                                                echo "<td> {$trans->getBook()->getNotes()}</td>";
                                                $seller = $_SESSION['info_controller']->getUserInfo($trans->getSeller());
                                                echo "<td> {$seller['name']}</td>";
                                                echo "<td> <a href='mailto:{$seller['email']}'>{$seller['email']}</a></td>";
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
                        <div class="row">
                            <div class="purchase col-lg-2"></div>
                            <div class="col-lg-12">
                                <a class="col-lg-8 purchase" name="sold" href="#sold">
                                    <div class="col-lg-8 purchase">SELL HISTORY</div>
                                </a>
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
                                                    <th data-hide="all">Author(s)</th>
                                                    <th data-hide="all">Book Condition</th>
                                                    <th data-hide="all">Notes</th>
                                                    <th data-hide="all">Buyer Name</th>
                                                    <th data-hide="all">Buyer Email</th>
                                                    <th data-hide="all">Buyer Phone</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                            
                                            foreach ($soldBooks as $trans){
                                                echo "<tr>";
                                                echo "<td class='fakeLink'> {$trans->getBook()->getTitle()}</td>";
                                                echo "<td> {$trans->getBook()->getIsbn()}</td>";
                                                echo "<td> <span class='label label-warning'>{$trans->getBook()->getCourseNum()}</span></td>";
                                                echo "<td>".'$'."{$trans->getBook()->getPrice()}.00</td>";
                                                $date = date("m/d/y",$trans->getTransDate());
                                                echo "<td class='text-right'> {$date}</td>";
                                                echo "<td> {$trans->getBook()->getAuthors()}</td>";
                                                echo "<td> {$trans->getBook()->getCondition()}</td>";
                                                echo "<td> {$trans->getBook()->getNotes()}</td>";
                                                $buyer = $_SESSION['info_controller']->getUserInfo($trans->getBuyer());
                                                echo "<td> {$buyer['name']}</td>";
                                                echo "<td> <a href='mailto:{$buyer['email']}'>{$buyer['email']}</a></td>";
                                                echo "<td> {$buyer['phone_num']}</td>";
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
            <?php include 'footer.php'; ?>
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
                var listingID; // used to store the book id for other functions on this page
                $('.delete_listing').click(function (evt) {
                    listingID = $(this).data("id");
                });
                
                var purchaseID; // used to store the transaction id for other functions on this page
                $('.delete_purchase').click(function (evt) {
                    purchaseID = $(this).data("id");
                });

                $('#removeListing').click(function (evt) {

                    $.ajax({
                        type: 'POST',
                        data: {
                            listingID: listingID
                        },
                        url: './php/removeListing.php',
                        success: function (data) {
                            location.reload();
                        }

                    });

                });
                
                $('#cancelPurchase').click(function (evt) {

                    $.ajax({
                        type: 'POST',
                        data: {
                            purchaseID: purchaseID
                        },
                        url: './php/cancelPurchase.php',
                        success: function (data) {
                            location.reload();
                        }

                    });

                });




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

                $('.footable').footable();


            });
        </script>

    </body>

    </html>
