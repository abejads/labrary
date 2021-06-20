<?php session_start(); ?>
<?php 

    if(!isset($_SESSION["uid"])){
        header("Location: index.php");
        die();
    }    
    
    require_once("include/connection.php"); 

    if(isset($_GET["id"]) && $_GET["id"] != "") {
        
        $id =  $_GET["id"];
        $doQuery = $conn->prepare("SELECT * FROM courses WHERE courseID = ?");
        
        if($doQuery->bind_param("i", $id) && $doQuery->execute()){

            $result = $doQuery->get_result();
            if($result->num_rows > 0){
                
                $course = $result->fetch_assoc();
                
                if(!isset($_SESSION["uid"]) && !isset($_SESSION["premium"])){
                    echo '<script>alert("Please login first to access this course"); window.location = "login.php";</script>';
                    die();   
                } else if($course["isPremium"] == 1 && $_SESSION["premium"] == 0){
                    echo '<script>alert("Course is Premium, Please upgrade your account to Premium"); window.location = "subscription.php";</script>';
                    die();
                } else {

                    $name = $course['courseName'];

                    $doQuery = $conn->prepare("SELECT * FROM rooms WHERE courseID = ?");

                    if($doQuery->bind_param("i", $id) && $doQuery->execute()){

                        $rooms = $doQuery->get_result();

                    } else {
                        header("Location: course.php");
                    }

                }

            } else {
                echo '<script>alert("Sorry, we dont have a room for that course :("); window.location = "course.php";</script>';
                die();
            }


        } else {
            echo '<script>alert("Error!")<script>';
            die();
        }

        
    } else {
        header("Location: course.php");
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Labrary - <?php echo $course["courseName"]; ?></title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <link type="text/css" rel="stylesheet" href="css/style.css"  media="screen,projection"/>
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="icon" href="img/icon.png">
        <style type="text/css">body{overflow: hidden};</style>
    </head>
    <body class="black">
        <ul id='playlist' class='dropdown-content'>
        <?php while($detail = $rooms->fetch_assoc()): ?>
            <li movieurl="<?php echo $detail['roomVideo']; ?>" movieposter="img/<?php echo $detail['roomThumbnail']; ?>"><?php echo $detail['roomList']; ?></li>
        <?php endwhile; ?>
        </ul>
        <ul class="sidenav" id="mobile-nav" style="padding-left:20px;">
        <?php while($detail = $rooms->fetch_assoc()): ?>
            <li movieurl="<?php echo $detail['roomVideo']; ?>" movieposter="img/<?php echo $detail['roomThumbnail']; ?>"><?php echo $detail['roomList']; ?></li>
        <?php endwhile; ?>
        </ul>

        <div class="navbar-fixed">
            <nav class="black">
                <div class="container">
                    <div class="nav-wrapper">
                        <div class="brand-logo black-text">
                            <a href="index.php"><i class="material-icons white-text">arrow_back</i></a><a></a><img src="img/logo-white.png" alt="" width="120px" height="22px"></img></a>
                        </div>
                        <div class="right hide-on-med-and-down">
                            <a class='dropdown-trigger btn' href='#' data-target='playlist'><?php echo $name; ?></a>
                            <?php 
                                $doQuery = $conn->prepare("SELECT * FROM labs WHERE labID = ?");

                                if($doQuery->bind_param("i", $id) && $doQuery->execute()){

                                    $labs = $doQuery->get_result();
                                    while($lab = $labs->fetch_assoc()){
                                        $labname = $lab['labPath'];
                                    }
                                } else {
                                    echo '<script>alert("Error loading LAB!")</script>';
                                }
                            ?>
                            <a class="waves-effect waves-light btn" href="lab/<?php echo $labname; ?>">Course Lab</a>
                        </div>
                        <a href="#" data-target="mobile-nav" class="sidenav-trigger"><i class="material-icons white-text">menu</i></a>
                    </div>
                </div>
            </nav>
        </div>

        <style>
            #playlist {
                display:table;
            }
            #playlist li{
                cursor:pointer;
                padding:8px;
            }
            #playlist li:hover{
                color:#26a69a;                        
            }
            #videoarea {
                display:block;
                margin:0 auto;
                width:80%;
                height:80%;
                border:1px solid silver;
            }
        </style>
        <video oncontextmenu="return false;" controls controlsList="nodownload" id="videoarea" controls="controls" autoplay poster="" src=""></video>
    </body>
    <script>
        // dropdown
        $('.dropdown-trigger').dropdown();
        
        // sidenav
        const sidenav = document.querySelectorAll('.sidenav');
        M.Sidenav.init(sidenav);
            
        const slider = document.querySelectorAll('.slider');
        M.Slider.init(slider, {
            indicators: false,
            height: 550
        });
        
        // video
        $(function() {
            $("#playlist li").on("click", function() {
                $("#videoarea").attr({
                    "src": $(this).attr("movieurl"),
                    "poster": "",
                    "autoplay": "autoplay"
                })
            })
            $("#videoarea").attr({
                "src": $("#playlist li").eq(0).attr("movieurl"),
                "poster": $("#playlist li").eq(0).attr("movieposter")
            })
        });
    </script>
</html>