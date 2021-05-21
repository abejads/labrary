<?php $title = "Courses"; include("header.php"); ?>
<?php 
    // -1  itu salah pass. 0 datanya ga ada. 
    // 3 = get course
    require_once("include/connection.php"); 

    if(isset($_POST["search"]) && $_POST["search"] != ""){

        $search = $_POST["search"];
        $doQuery = $conn->prepare("SELECT * FROM courses WHERE courseName LIKE CONCAT('%',?,'%')");

        if($doQuery->bind_param("s", $search) && $doQuery->execute()){
            $result = $doQuery->get_result();

            if($result->num_rows > 0){

                $error = 1;

            } else {
                $error = 0;
            }

        } else {
            echo '<script>alert("Error!")<script>';
            die();
        }
        

    } else if(isset($_GET["id"]) && $_GET["id"] != "") {
        
        $id =  $_GET["id"];
        $doQuery = $conn->prepare("SELECT * FROM courses WHERE courseID = ?");
        
        if($doQuery->bind_param("i", $id) && $doQuery->execute()){

            $result = $doQuery->get_result();

            if($result->num_rows > 0){

                $error = 3;

            } else {
                $error = 0;
            }


        } else {
            echo '<script>alert("Error!")<script>';
            die();
        }

        
    } else {

        $error = -1;
    }
  
?>


<div class="container"> 
    <?php if($error == -1): ?>
    <section id="services" class="services" style="padding-bottom: 100px">
        <div class="row">
            <h3 class="center">Courses</h3> 
            <div class="col m4 s12">
                <div class="card">
                    <div class="card-image waves-effect waves-block waves-light">
                        <img class="activator" src="img/web-security.jpg" width="512" height="240">
                    </div>
                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4">Basic Web Security<i class="material-icons right">more_vert</i></span>
                        <p><a style="color:#000" href="./course.php?id=1">Go to course</a></p>
                    </div>
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4">Basic Web Security<i class="material-icons right">close</i></span>
                        <p>Websites all around the world are programmed using various programming languages. While there are specific vulnerabilities in each programming langage that the developer should be aware of, there are issues fundamental to the internet that can show up regardless of the chosen language or framework.</p>
                    </div>
                </div>
            </div> 
            <div class="col m4 s12">
                <div class="card">
                    <div class="card-image waves-effect waves-block waves-light">
                        <img class="activator" src="img/binex.jpeg" width="512" height="240">
                    </div>
                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4">Basic Binary Exploitation<i class="material-icons right">more_vert</i></span>
                        <p><a style="color:#000" href="/course.php?id=2">Go to course</a></p>
                    </div>
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4">Basic Binary Exploitation<i class="material-icons right">close</i></span>
                        <p>Binary Exploitation is a broad topic within Cyber Security which really comes down to finding a vulnerability in the program and exploiting it to gain control of a shell or modifying the program's functions.</p>
                    </div>
                </div>
            </div> 
            <div class="col m4 s12">
                <div class="card">
                    <div class="card-image waves-effect waves-block waves-light">
                        <img class="activator" src="img/reversing.jpg" width="512" height="240">
                    </div>
                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4">Basic Reverse Engineering<i class="material-icons right">more_vert</i></span>
                        <p><a style="color:#000" href="/course.php?id=3">Go to course</a></p>
                    </div>
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4">Basic Reverse Engineering<i class="material-icons right">close</i></span>
                        <p>Reverse Engineering is typically the process of taking a compiled (machine code, bytecode) program and converting it back into a more human readable format.</p>
                    </div>
                </div>    
            </div> 
        </div>
    </section>
</div>

<?php elseif($error == 0): ?>
<h3 style="padding-top: 5%;">Course Not found</h3> 
<h5 style="padding-bottom: 32%">Sorry, maybe later :(</h5>
</div>

<?php elseif($error == 1): ?>
<h3  style="margin-top: 60px;">Search Result</h3> 
<section id="services" class="services" style="padding-bottom: 100px">
    <div class="row">
        <?php while($course = $result->fetch_assoc()):?>
        <div class="col m4 s12">
            <div class="card">
                <div class="card-image waves-effect waves-block waves-light">
                    <img class="activator" src="img/<?php echo $course["courseImage"]; ?>">
                </div>
                <div class="card-content">
                    <span class="card-title activator grey-text text-darken-4"><?php echo $course["courseName"]; ?><i class="material-icons right">more_vert</i></span>
                    <p><a style="color:#26a69a;" href="./course.php?id=<?php echo $course["courseID"]; ?>#web-hacking">Go to course</a></p>
                </div>
                <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4"><?php echo $course["courseName"]; ?><i class="material-icons right">close</i></span>
                    <p><?php echo $course["courseDetails"]; ?></p>
                </div>
            </div>
        </div> 
        <?php endwhile ; ?>
    </div>
</section>
</div>

<?php elseif($error == 3):
    $course = $result->fetch_assoc();
?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<!--INI KODE BUAT BENERIN IFRAME DI MOBILE -->
<style>
    #playlist {
        display: column;
        float: right;
        text-align: left;
        font-size: 24px;
        margin-right: 80px;
        margin-left: 20px;
        margin-top: 0px;
        margin-bottom: 0px;
    }
    #playlist li {
        cursor: pointer;
        padding: 10px;
    }
    #playlist li:hover {
        color: #26a69a;
    }
    #videoarea {
        float: center;
        width: 720px;
        height: 576px;
        margin-top: 10px;
        margin-left: 10px;
        margin-bottom: 10px;
        border: 3px solid grey;
        max-width: 100%;
        max-height: 100%;
    }
</style>
<!-- XIXIXI -->
<section id="web-hacking" class="services" style="padding-bottom: 100px">
    <h3 style="margin-top: 30px;" class="center"><?php echo $course["courseName"]; ?></h3> 
    <h5 class="center"><?php echo $course["courseAuthor"]; ?></h5></br></br>
    <div class="black card-panel center">
        <video id="videoarea" oncontextmenu="return false;" controls="controls" controls controlsList="nodownload" poster="" src="" type="video/mp4"></video>
        <ul id="playlist" class="white-text">
            <h3>List of Contents</h3>
            <hr>
            <li movieurl="http://labrary.my.id/video/1_ Web - Beberapa terminologi dasar HTTP.mp4" movieposter="img/cysecipb.png">1. Basic HTTP Terminology</li>
            <li movieurl="http://labrary.my.id/video/2_ Web - PHP local file inclusion (LFI).mp4" movieposter="img/cysecipb.png">2. PHP local file inclusion (LFI)</li>
            <li movieurl="http://labrary.my.id/video/3_ Web - PHP remote file inclusion (RFI).mp4" movieposter="img/cysecipb.png">3. PHP remote file inclusion (RFI)</li>
            <li movieurl="#" movieposter="">4. File upload vulnerability</li>
            <li movieurl="#" movieposter="">5. Basic SQL injection</li>
            <li movieurl="#" movieposter="">6. SQL injection UNION</li>
            <li movieurl="#" movieposter="">7. Blind SQL Injection</li>
            <li movieurl="#" movieposter="">8. Blind SQL Injection (time-based)</li>
        </ul>
    </div>
</section>
</div>
<?php endif; ?>
<script>
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
    })
</script>
<?php include("footer.php"); ?>