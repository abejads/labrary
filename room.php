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
                }

            } else {
                $error = 0;
            }


        } else {
            echo '<script>alert("Error!")<script>';
            die();
        }

        
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
    </head>
    <body class="black">
        <div class="navbar-fixed">
            <nav class="black">
                <div class="container">
                    <div class="nav-wrapper">
                        <div class="brand-logo black-text">
                            <i class="material-icons white-text">arrow_back</i><a href="index.php"><img src="img/logo-white.png" alt="" width="120px" height="22px"></img></a>
                        </div>
                        <div class="right hide-on-med-and-down">
                            <a class='dropdown-trigger btn' href='#' data-target='playlist'>Basic Web Security</a>
                            <a class="waves-effect waves-light btn" href="lab/lab_basic-security_admin.php">Course Lab</a>
                        </div>
                        <a href="#" data-target="mobile-nav" class="sidenav-trigger"><i class="material-icons white-text">menu</i></a>
                    </div>
                </div>
            </nav>
        </div>
        <ul id='playlist' class='dropdown-content'>
            <li movieurl="http://labrary.my.id/course/video/terminologi_dasar_HTTP.mp4" movieposter="img/cysecipb.png">1. Terminologi Dasar HTTP</li>
            <li movieurl="http://labrary.my.id/course/video/PHP_local_file_inclusion_(LFI).mp4" movieposter="img/cysecipb.png">2. PHP Local File Inclusion (LFI)</li>          
            <li movieurl="http://labrary.my.id/course/video/PHP_remote_file_inclusion_(RFI).mp4" movieposter="img/cysecipb.png">3. PHP Remote File Inclusion (RFI)</li>
        </ul>
        <ul class="sidenav" id="mobile-nav" style="padding-left:20px;">
            <li movieurl="http://labrary.my.id/course/video/terminologi_dasar_HTTP.mp4" movieposter="img/cysecipb.png">1. Terminologi Dasar HTTP</li>
            <li movieurl="http://labrary.my.id/course/video/PHP_local_file_inclusion_(LFI).mp4" movieposter="img/cysecipb.png">2. PHP Local File Inclusion (LFI)</li>          
            <li movieurl="http://labrary.my.id/course/video/PHP_remote_file_inclusion_(RFI).mp4" movieposter="img/cysecipb.png">3. PHP Remote File Inclusion (RFI)</li>
        </ul>
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