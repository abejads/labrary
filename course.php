<?php $title = "Courses"; include("header.php"); ?>
<?php 
    // -1  itu salah pass. 0 datanya ga ada. 
    // 3 = get course
    // 10 = course premium, account free -> dont have access

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
                        <p><a style="color:#000" href="course.php?id=1">Go to course</a></p>
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
                        <p><a style="color:#000" href="course.php?id=2">Go to course</a></p>
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
                        <p><a style="color:#000" href="course.php?id=3">Go to course</a></p>
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
                    <p><a style="color:#26a69a;" href="course.php?id=<?php echo $course["courseID"]; ?>#web-hacking">Go to course</a></p>
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

<?php elseif($error == 3): $course = $result->fetch_assoc();?>
    
        <section id="web-hacking" class="services" style="padding-bottom: 100px">
            <h3 style="margin-top: 30px;" class="center"><?php echo $course["courseName"]; ?></h3> 
            <h5 class="center">by <?php echo $course["courseAuthor"]; ?></h5></br></br>
            <div class="black card-panel center"><img src="img/<?php echo $course["courseImage"]; ?>"></div>
            <p style="font-size: 20px"><?php echo $course["courseDetails"]; ?></p>
            <div class="col m12 s12">
                <a style="width: 100%;" href="room.php?id=<?php echo $course["courseID"]; ?>" class="waves-effect waves-light btn-large">Go To Course</a>
            </div>
        </section>
        </div>

<?php endif; ?>
<?php include("footer.php"); ?>