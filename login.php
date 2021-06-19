<?php $title = "Login"; include("header.php"); ?>
<?php 
    if(isset($_SESSION["uid"])){
        header("Location: account.php");
        die();
    }
    // -1  itu salah pass. 0 data postnya ga ada. 
    require_once("include/connection.php"); 

    if(isset($_POST["email"]) && $_POST["email"] != "" && isset($_POST["password"]) && $_POST["password"] != "" ){
        
        $password = $_POST["password"];
        $email = $_POST["email"];
        $doQuery = $conn->prepare("SELECT * FROM users WHERE email = ?");

        if($doQuery->bind_param("s", $email) && $doQuery->execute()){
            $result = $doQuery->get_result();
            $result = $result->fetch_assoc();

            if(password_verify($password, $result["password"])){
                
                $_SESSION["uid"] = $result["id"];
                $_SESSION["premium"] = $result["premium"];
                echo "<script> location.href='account.php'; </script>";
                 exit;

                
            } else {
                $error = -1;
                
            }
            
        } else {
            echo '<script>alert("Error!")<script>';
        }
        

    } else {
        $error = 0;
    }

    
    
?>


    
<div class="container">
    <div id="login-page" class="row">
        <h1>Login</h1>
        <div class="col s12 z-depth-6 card-panel">
            <form class="login-form" method="POST">
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">mail_outline</i>
                    <input class="validate" id="email" type="email" name="email">
                    <label for="email">Email</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">lock_outline</i>
                    <input id="password" type="password" name="password">
                    <label for="password">Password</label>
                    <?php if($error == -1): ?>
                    <p style="color:red">&ensp;&ensp;Email / password salah!</p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <button class="btn waves-effect waves-light col s12">Login</button>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6 m6 l6">
                    <p class="margin medium-small">Don't have an account? <a style="color:#26a69a;" href="register.php">Register Now!</a></p>
                </div>
                    <!--
                    <div class="input-field col s6 m6 l6">
                        <p class="margin right-align medium-small"><a href="#">Forgot password?</a></p>
                    </div>          
                -->
                </form>
            </div>
        </div>
    </div> 
</div>
<?php include("footer.php"); ?>
    </body>
</html>