<?php
class NavView{
    public function makeLoggedInNavBar(){
        return '<div class="row">
                            <nav class="navbar navbar--top" role="navigation">
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
                                             <ul id="notifications" class="dropdown-menu dropdown-alerts" style="width: 400px; background-color: white;">

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

    }
    public function makeLoggedOutNavBar(){
        return '<div class="row">
                            <nav class="navbar navbar--top" role="navigation">
                                <div class="navbar-header">
                                    <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" style="background-color: transparent" type="button">
                                        <i class="fa fa-reorder"></i>
                                    </button>
                                    <span>
                                <a href="home.php" class="navbar-brand">Duke 
                                <span class="smaller">EXCHANGE</span></a>
                                    </span>
                                </div>
                                <div class="navbar-collapse collapse" id="navbar">
                                    <ul class="nav navbar-nav navbar-right">
                                        <li>
                                            <a href="how_it_works.php">
                                                <i class="fa fa-question-circle" aria-hidden="true"></i>How It Works
                                            </a>
                                        </li>
                                        <li>
                                            <a href="oauth.php">
                                                <i class="fa fa-sign-in"></i>Log in
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </nav>
                        </div>';

    } 
    public function makeFooter(){
        return '          <br>
                        <div class="footer">
                            <span><a href="about_us.php" class="footer-tag">About us</a></span>
                            <span class="pull-right"><a href="mailto:dukeexchange@gmail.com" class="footer-tag">Contact us</a></span>
                        </div>';
        
    }
    
}

?>
