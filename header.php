<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Labrary - <?php echo $title; ?></title>
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <!--Let browser know website is optimized for mobile-->
        <link type="text/css" rel="stylesheet" href="css/style.css"  media="screen,projection"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="icon" href="img/icon.png">
    </head>

    <body>
        
<!-- navbar -->
        <div class="navbar-fixed">
            <nav class="black">
                <div class="container">
                    <div class="nav-wrapper">
                        <div class="brand-logo black-text">
                            <a href="index.php"><img src="img/logo-white.png" alt="" width="120px" height="22px" href></img></a>
                        </div>
                        <a href="#" data-target="mobile-nav" class="sidenav-trigger"><i class="material-icons white-text">menu</i></a>
                        <ul class="right hide-on-med-and-down">
                        <form method="POST" action="course.php">
                            <li class="search"> 
                                <div class="center row">
                                    <div class="col s12" >
                                        <div class="row" id="topbarsearch">
                                            <div class="input-field col s6 s12 white-text">
                                                <i class="material-icons prefix left">search</i>
                                                <input type="text" placeholder="Search Courses" name="search" id="autocomplete-input" size="40" class="autocomplete white-text">                                  
                                            </div>
                                        </div>
                                    </div>
                                </div>          
                            </li>        
                             <?php if(!isset($_SESSION["uid"])): ?>
                            <li><a href="register.php">Register</a></li>
                            <li><a href="login.php">Login</a></li>
                            <?php else: ?>
                            <li><a href="account.php">My Account</a></li>
                            <li><a href="course.php">Courses</a></li>
                            <li><a href="logout.php">Logout</a></li>
                            <?php endif; ?>
                        </ul> 
                        </form>
                    </div>
                </div>
            </nav>
        </div>
                

        <!-- sidenav -->
        <ul class="sidenav" id="mobile-nav">
            <?php if(!isset($_SESSION["uid"])): ?>
            <li><a href="login.php"><i class="material-icons prefix">group</i>Login</a></li>
            <li><a href="register.php"><i class="material-icons prefix">group_add</i>Register</a></li>
            <?php else: ?>
            <li><a href="account.php"><i class="material-icons prefix">account_circle</i>My Account</a></li>
            <li><a href="course.php"><i class="material-icons prefix">library_books</i>Courses</a></li>
            <li><a href="logout.php"><i class="material-icons prefix">subdirectory_arrow_left</i>Logout</a></li>
            <?php endif; ?>
        </ul> 
