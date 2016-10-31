<?php
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

        <title>Sell | Duke Exchange</title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
        <!-- for dropdown -->
        <link href="css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">
        <!-- Bill custom stylesheet -->
        <link href="css/sell_integrated.css" rel="stylesheet">
        <link href="css/home.css" rel="stylesheet">
        <style>
            .wizard {
                margin: 20px auto;
                background: #fff;
            }
            
            .wizard .nav-tabs {
                position: relative;
                margin: 40px auto;
                margin-bottom: 0;
                border-bottom-color: #e0e0e0;
            }
            
            .wizard > div.wizard-inner {
                position: relative;
            }
            
            .connecting-line {
                height: 2px;
                background: #e0e0e0;
                position: absolute;
                width: 80%;
                margin: 0 auto;
                left: 0;
                right: 0;
                top: 50%;
                z-index: 1;
            }
            
            .wizard .nav-tabs > li.active > a,
            .wizard .nav-tabs > li.active > a:hover,
            .wizard .nav-tabs > li.active > a:focus {
                color: #555555;
                cursor: default;
                border: 0;
                border-bottom-color: #E0E0E0;
            }
            
            span.round-tab {
                width: 70px;
                height: 70px;
                line-height: 70px;
                display: inline-block;
                border-radius: 100px;
                background: #fff;
                border: 2px solid #e0e0e0;
                z-index: 2;
                position: absolute;
                left: 0;
                text-align: center;
                font-size: 25px;
            }
            
            span.round-tab i {
                color: #555555;
            }
            
            .wizard li.active span.round-tab {
                background: #fff;
                border: 2px solid #001A57;
            }
            
            .wizard li.active span.round-tab i {
                color: #001A57;
            }
            
            span.round-tab:hover {
                color: #333;
                border: 2px solid #333;
            }
            
            .wizard .nav-tabs > li {
                width: 20%;
            }
            
            .wizard li:after {
                content: " ";
                position: absolute;
                left: 46%;
                opacity: 0;
                margin: 0 auto;
                bottom: 0px;
                border: 5px solid #E0E0E0;
                border-bottom-color: black;
                transition: 0.1s ease-in-out;
            }
            
            .wizard li.active:after {
                content: " ";
                position: absolute;
                left: 46%;
                opacity: 1;
                margin: 0 auto;
                bottom: 0px;
                border: 10px solid transparent;
                border-bottom-color: #5bc0de;
            }
            
            .wizard .nav-tabs > li a {
                width: 70px;
                height: 70px;
                margin: 20px auto;
                border-radius: 100%;
                padding: 0;
            }
            
            .wizard .nav-tabs > li a:hover {
                background: transparent;
            }
            
            .wizard .tab-pane {
                position: relative;
                padding-top: 50px;
            }
            
            .wizard h3 {
                margin-top: 0;
            }
            
            @media( max-width: 585px) {
                .wizard {
                    width: 90%;
                    height: auto !important;
                }
                span.round-tab {
                    font-size: 16px;
                    width: 50px;
                    height: 50px;
                    line-height: 50px;
                }
                .wizard .nav-tabs > li a {
                    width: 50px;
                    height: 50px;
                    line-height: 50px;
                }
                .wizard li.active:after {
                    content: " ";
                    position: absolute;
                    left: 35%;
                }
            }
        </style>
    </head>

    <body class="top-navigation">
        <div id="myModal" class="modal fade" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Book Added</h4>
                    </div>
                    <div class="modal-body">
                        <img class="cover" src="" style="max-width:140px; max-height:200px" ;>
                        <p id="addSummary"></p>
                    </div>
                    <div class="modal-footer">
                        <input id='ok' type="button" class="btn btn-primary" data-dismiss="modal" value="Okay">
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <div id="wrapper">
            
            <div id="page-wrapper" class="gray-bg">
                <?php include 'navbar.php'; ?>
                <div class="wrapper wrapper-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="ibox">

                                    <div class="ibox-content">
                                        <h2>
                                Sell A Book
                            </h2>
                                        <p>
                                            Want to sell your book? It's easy- just follow the steps below. 
                                            <img src="img/poweredgoogle.png"></img>
                                        </p>

                                        <section>
                                            <div class="wizard">
                                                <div class="wizard-inner">
                                                    <div class="connecting-line"></div>
                                                    <ul class="nav nav-tabs" role="tablist">

                                                        <li role="presentation" class="active">
                                                            <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Textbook">
                                                                <span class="round-tab">
                                <i class="glyphicon glyphicon-book"></i>
                            </span>
                                                            </a>
                                                        </li>

                                                        <li role="presentation" class="disabled">
                                                            <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Course">
                                                                <span class="round-tab">
                                <i class="glyphicon glyphicon-menu-hamburger"></i>
                            </span>
                                                            </a>
                                                        </li>
                                                        <li role="presentation" class="disabled">
                                                            <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Book Condition">
                                                                <span class="round-tab">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </span>
                                                            </a>
                                                        </li>

                                                        <li role="presentation" class="disabled">
                                                            <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab" title="Price">
                                                                <span class="round-tab">
                                <i class="glyphicon glyphicon-usd"></i>
                            </span>
                                                            </a>
                                                        </li>
                                                         <li role="presentation" class="disabled">
                                                            <a href="#step5" data-toggle="tab" aria-controls="step5" role="tab" title="Confirm">
                                                                <span class="round-tab">
                                <i class="glyphicon glyphicon-arrow-right"></i>
                            </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <form id="addBook" method="post" action="./php/add_book.php">
                                                    <div class="tab-content">


                                                        <div class="tab-pane active" role="tabpanel" id="step1">
                                                            <h3>Textbook</h3>

                                                            <label>Search</label>
                                                            <input id="search" name="search" type="text" class="form-control" placeholder="ISBN, Title, Author, etc.">
                                                            <br>
                                                            <hr class="hr-line-solid">
                                                            <div class="form-group">
                                                                <label>ISBN</label>
                                                                <input id="isbn" name="isbn" type="text" class="form-control required">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Title of Book</label>
                                                                <input id="title" name="title" type="text" class="form-control required">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Published Date</label>
                                                                <input id="publishDate" name="publishDate" type="text" class="form-control required">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Author(s)</label>
                                                                <input id="authors" name="authors" type="text" class="form-control required">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Book Cover Url</label>
                                                                <input id="coverURL" name="coverURL" type="text" class="form-control required">
                                                                <br>
                                                                <img class="cover" src="" style="max-width:140px; max-height:200px" ;>
                                                            </div>
                                                            <ul class="list-inline pull-right">
                                                                <li>
                                                                    <button type="button" class="btn btn-primary next-step">Save and continue</button>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="tab-pane" role="tabpanel" id="step2">
                                                            <h3>Course</h3>
                                                            <div class="form-group">
                                                                <label>Course Name (i.e. Math 212 or Multivariable Calculus)</label>
                                                                <input id="course" name="course" type="text" class="typeahead_1 form-control required">
                                                            </div>
                                                            <!--
                                        <div class="form-group">
                                            <label>Course Number (i.e. Math 212) </label>
                                            <input id="courseNumber" name="courseNumber" type="text" class="form-control required">
                                        </div>
-->

                                                            <ul class="list-inline pull-right">
                                                                <li>
                                                                    <button type="button" class="btn btn-default prev-step">Previous</button>
                                                                </li>
                                                                <li>
                                                                    <button type="button" class="btn btn-primary next-step">Save and continue</button>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="tab-pane" role="tabpanel" id="step3">
                                                            <h3>Book Condition</h3>
                                                            <div class="form-group">
                                                                <label>Condition</label>
                                                                <div>
                                                                    <select name='bookCondition' data-placeholder="Choose some condition" class="chosen-select form-control" tabindex="1">
                                                                        <option value="New">New</option>
                                                                        <option value="Very Good">Very Good</option>
                                                                        <option value="Good">Good</option>
                                                                        <option value="Fair">Fair</option>
                                                                        <option value="Poor">Poor</option>
                                                                        <option value="UNC Crapple Hill">UNC Crapple Hill</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Notes</label>
                                                                <input id="notes" name="notes" type="text" class="form-control">
                                                            </div>
                                                            <ul class="list-inline pull-right">
                                                                <li>
                                                                    <button type="button" class="btn btn-default prev-step">Previous</button>
                                                                </li>
                                                                <li>
                                                                    <button type="button" class="btn btn-primary btn-info-full next-step">Save and continue</button>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="tab-pane" role="tabpanel" id="step4">
                                                            <div class="form-group">
                                                                <label>Price</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">$</span>
                                                                    <input id="price" name="price" type="text" class="form-control"><span class="input-group-addon">.00</span>
                                                                </div>
                                                            </div>
                                                            <ul class="list-inline pull-right">
                                                                <li>
                                                                    <button type="button" class="btn btn-default prev-step">Previous</button>
                                                                     <button id="confirm" type="button" class="btn btn-primary btn-info-full next-step">Sell</button>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="tab-pane" role="tabpanel" id="step5">
                                                        <h2>You are about to sell this book. Continue?</h2>
                                                            <ul class="list-inline pull-right">
                                                                <li>
                                                                    <button type="button" class="btn btn-default prev-step">Previous</button>
                                                                    <input type="submit" class="btn btn-primary" value="Sell">
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </form>
                                            </div>
                                        </section>

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
                <div class="footer">
                    <!--
                <div class="pull-right">
                    10GB of <strong>250GB</strong> Free.
                </div>
                <div>
                    <strong>Copyright</strong> Example Company &copy; 2014-2017
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

        <!-- Chosen -->
        <script src="js/plugins/chosen/chosen.jquery.js"></script>


        <!-- Typehead -->
        <script src="js/plugins/typehead/bootstrap3-typeahead.min.js"></script>


        <script>
            $(document).ready(function () {
                //prevents users from pressing enter and submitting
                $(window).keydown(function(event){
                    if(event.keyCode == 13) {
                        event.preventDefault();
                        return false;
                    }
                });
                $('#search').keyup(function (e) {
                    var search = $('#search').val();
                    //alert(search);
                    $.ajax({
                        url: './php/findBook.php',
                        dataType: "json",
                        data: {
                            search: search
                        },
                        type: 'POST',
                        success: function (data) {
                            if (!data.error) {
                                $('#isbn').val(data.isbn)
                                $('#title').val(data.title); // for form
                                // $('.title').text(data.title); // for modal
                                $('#publishDate').val(data.date);
                                $('#authors').val(data.authors);
                                $('#coverURL').val(data.cover);
                                $('.cover').attr('src', data.cover);

                            }
                        }
                    });

                });
                $('#coverURL').keyup(function () {
                    var cover = $('#coverURL').val();
                    $('.cover').attr('src', cover);
                });
                //Initialize tooltips
                $('.chosen-select').chosen({
                    width: "100%"
                });
                $('.nav-tabs > li a[title]').tooltip();

                //Wizard
                $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

                    var $target = $(e.target);

                    if ($target.parent().hasClass('disabled')) {
                        return false;
                    }
                });

                $(".next-step").click(function (e) {

                    var $active = $('.wizard .nav-tabs li.active');
                    $active.next().removeClass('disabled');
                    nextTab($active);

                });
                $(".prev-step").click(function (e) {

                    var $active = $('.wizard .nav-tabs li.active');
                    prevTab($active);

                });


                function nextTab(elem) {
                    $(elem).next().find('a[data-toggle="tab"]').click();
                }

                function prevTab(elem) {
                    $(elem).prev().find('a[data-toggle="tab"]').click();
                }
                $('#confirm').click(function (e) { // when person clicks okay on modal
                    var title = $('#title').val();
                    var price = $('#price').val();
                    var summary1 = 'You are about to post the following listing: "';
                    var summary = summary1.concat(title, '" for $');
                    summary = summary.concat(price, '.');
                    $('#step5 h2').text(summary).append('<br/><br/>').append("<h4> Press sell to post this listing. <h4>");

                }); 
                $('#ok').click(function (e) { // when person clicks okay on modal
                    location.reload();

                });

                $('#addBook').submit(function (evt) {
                    //$('#addBook').load("./php/add_book.php");
                    evt.preventDefault(); // only sends data if data is entered
                    var postData = $(this).serialize(); // postData is POST data with the string name of form elements
                    var title = $('#title').val();
                    var price = $('#price').val();
                    var summary1 = 'You have added ';
                    var summary = summary1.concat(title, ' for $');
                    summary = summary.concat(price, ' to the market place.');
                    $('#addSummary').text(summary) // prints summary of book added in modal
                    var url = $(this).attr('action'); // in form html code as add_book.php
                    $.post(url, postData, function (data) {
                        //$('#addBook').trigger("reset");

                        $('#myModal').modal('show');
                        // alert("Transaction Completed");


                    });


                });
                $.get('./php/courses.json', function (data) {
                    $(".typeahead_1").typeahead({
                        source: data.courses
                    });
                }, 'json');

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