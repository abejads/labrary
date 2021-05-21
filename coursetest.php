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
        <ul class="sidenav" id="mobile-nav">
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