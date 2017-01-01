    <?php  
echo '
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
                                    <a aria-expanded="false" role="button" href="home.php"><i class="fa fa-shopping-bag" aria-hidden="true"></i>Buy</a>
                                </li>
                                <li>
                                    <a aria-expanded="false" role="button" href="sell.php"><i class="fa fa-tag" aria-hidden="true"></i>Sell</a>
                                </li>

                                <li>
                                    <a aria-expanded="false" role="button" href="myAccount.php"><i class="fa fa-user" aria-hidden="true"></i>My Account</a>
                                </li>
                                <li id="readNotifications" class="dropdown">
                                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">

                                        <i class="fa fa-bell"></i> <span id="unreadNotifications" class="label label-danger"></span> 
                                        Notifications
                                    </a>
                                     <ul id="notifications" class="dropdown-menu dropdown-alerts" style="width: 380px; background-color: white;">

                                    </ul>

                                </li>
                                <li>
                                    <a href="./help.php">
                                        <i class="fa fa-question-circle" aria-hidden="true"></i>Help
                                    </a>
                                </li>
                                <li>
                                    <a href="./php/logout.php">
                                        <i class="fa fa-sign-out" aria-hidden="true"></i>Log out
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </nav>
                </div>';
    ?>