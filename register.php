<?php $title = "Register"; include("header.php");?>
<?php 
    if(isset($_SESSION["uid"])){
        header("Location: account.php");
        die();
    }
    // error 5 email udah ada
        
    require_once("include/connection.php"); 
    
    if(isset($_POST["email"]) && $_POST["email"] != "" && isset($_POST["password"]) && $_POST["password"] != "" && isset($_POST["name"]) && $_POST["name"] != "" && strlen($_POST['name']) <= 30 ){

        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $address = "";
        $telephone = "";
        $isPremium = 0;


        $doQuery = $conn->prepare("SELECT * FROM users WHERE email = ?");

        if($doQuery->bind_param("s", $email) && $doQuery->execute()){
            
            $result = $doQuery->get_result();
            
            if($result->num_rows != 0){
              $error = 5;
            } else {

              $doQuery = $conn->prepare("INSERT INTO users(name, email, password, address, telephone, premium) VALUES (?, ?, ?, ?, ?, ?)");

              if($doQuery->bind_param("sssssi", $name, $email, $password, $address, $telephone, $isPremium) && $doQuery->execute()){
                  
                  echo '<script>alert("Registrasi sukses!")</script>';
    
              } else {
                  echo '<script>alert("Error!")</script>';
              }

            }

        } else {
            echo '<script>alert("Error!")</script>';
        }

    } else {
        $error = 0;
    }    

    
?>
<div class="container">
    <div id="login-page" class="row">
        <h1>Register</h1>
        <div class="col s12 z-depth-6 card-panel" style="padding: 1em 1.5em; ">
            <form class="login-form" method="POST">
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">assignment_ind</i>
                    <input id="name" type="text" name="name" maxlength="30">
                    <label for="name">Name</label>
                </div>
            </div>
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
                    <?php if($error == 5): ?>
                    <p style="color:red">&ensp;&ensp;Email sudah terdaftar</p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <button class="btn waves-effect waves-light col s12">Register</button>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6 m6 l6">
                    <p class="margin medium-small">Already have an account?<a style="color:#26a69a;" href="login.php"> Login!</a></p>
                </div>
            <!--
                <div class="input-field col s6 m6 l6">
                    <p class="margin right-align medium-small"><a href="#">Forgot password?</a></p>
                </div>          
            -->
            </div>
            </form>
        </div>
    </div> 
</div>
<?php include("footer.php"); ?>
    </body>
</html>