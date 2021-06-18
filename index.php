<?php $title = "Online Couses Cyber Security"; ?>
<?php include("header.php"); ?>
<?php

    require_once("include/connection.php"); 

    $doQuery = $conn->prepare("SELECT * FROM courses");
        
    if($doQuery->execute()){    

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

?>

        <!-- slider -->
        <div class="slider">
            <ul class="slides">
            <li>
                <img src="./img/1.jpg">
                <div class="caption right-align">
                <h3>Cybersecurity Professional Development Platform</h3>
                <h5 class="light grey-text text-lighten-3">Hands-on experiences to gain real-world skills</h5>
                </div>
            </li>
            <li>
                <img src="./img/2.jpg">
                <div class="caption left-align">
                <h3>Cybersecurity Professional Development Platform</h3>
                <h5 class="light grey-text text-lighten-3">Guided career paths and role-based learning</h5>
                </div>
            </li>
            <li>
                <img src="./img/3.jpg">
                <div class="caption left-align">
                <h3>Cybersecurity Professional Development Platform</h3>
                <h5 class="light grey-text text-lighten-3">Industry certification courses with practice tests</h5>
                </div>
            </li>
            <li>
                <img src="./img/4.jpg">
                <div class="caption left-align">
                    <h3>Cybersecurity Professional Development Platform</h3>
                    <h5 class="light grey-text text-lighten-3">Dedicated mentors and professional networking</h5>
                </div>
            </li>
            </ul>
        </div>
       <div class="container">
            <section id="courses" class="services" style="padding-bottom: 100px">
                <div class="row">
                    <hr style="width:8%;height:4px;background-color:#26a69a;text-align:center;">
                    <h3 class="center">Popular Courses</h3></br>

                <?php while($course = $result->fetch_assoc()): ?>
                    <div class="col m4 s12">
                        <div class="card">
                            <div class="card-image waves-effect waves-block waves-light">
                                <img class="activator" src="img/<?php echo $course['courseImage']; ?>" width="500" height="240">
                            </div>
                            <div class="card-content">
                                <span class="card-title activator grey-text text-darken-4"><?php echo $course['courseName']; ?><i class="material-icons right">more_vert</i></span>
                                <p><a style="color:#000" href="course.php?id=<?php echo $course['courseID']; ?>">Go to course</a></p>
                            </div>
                            <div class="card-reveal">
                                <span class="card-title grey-text text-darken-4"><?php echo $course['courseName']; ?><i class="material-icons right">close</i></span>
                                <p><?php echo $course['courseDetails']; ?></p>
                            </div>
                        </div>
                    </div> 
                <?php endwhile; ?>
                </div>
            </section>
        </div>
        <hr style="width:90%;height:1px;background-color:#000;text-align:center;">
        <div class="container">
            <section id="services" class="services" style="padding-bottom: 100px">
                <div class="row">
                    <hr style="width:8%;height:4px;background-color:#26a69a;text-align:center;">
                    <h3 class="center">Our Services</h3> 
                    <h6 class="center">Hands-on learning experiences provide the most engaging and effective way to learn real-world concepts and skills that you need to be successful. </br>We build and aggregate over 1,000 secure, browser-based virtual labs, practice tests, and assessments in fields such as cybersecurity, </br>IT, cloud technologies, data science, and more.</h6>
                    <!--blablabla--></br></br></br>
                    <div class="col m4 s12">
                        <img src="img/lab.png" alt="" width="10%" height="10%"></img></br>
                        <b><font color="#000" size="5">Virtual Labs</font></b>
                        <div class="black-text">Get the hands-on experience businesses are looking for with hundreds of browser-based virtual labs that allow you to work with industry applications and technologies in objective-based scenarios, securely, from wherever you are.</div>
                    </div> 
                    <div class="col m4 s12">
                        <img src="img/note.png" alt="" width="10%" height="10%"></img></br>
                        <b><font color="#000" size="5">Certification Preparation</font></b>
                        <div class="black-text">Prepare for in-demand industry certifications with courses, virtual labs, and practice tests tied directly to the exam’s learning objectives.</div>
                    </div> 
                    <div class="col m4 s12">
                        <img src="img/write.png" alt="" width="10%" height="10%"></img></br>
                        <b><font color="#000" size="5">Skills Development and Assessment</font></b>
                        <div class="black-text">Track your career development and understand your strengths and weaknesses with over 200 skill assessments, that provide clarity on your next step.</div>
                    </div> 
                </div>
            </section>
        </div>
        <!--<hr class="grey lighten-2">-->
        <?php include("footer.php");?>
    </body>
</html>
        