<?php $title = "My Account"; include("header.php") ?>
<?php
    
    
    include("include/function.php");
    require_once("include/connection.php"); 

    if(!isset($_SESSION["uid"])){
        header("Location: index.php");
        die();
    }

    if((isset($_POST["email"]) && $_POST["email"] != "") || (isset($_POST["name"]) && $_POST["name"] != "") || (isset($_POST["telephone"]) && $_POST["telephone"] != "")  || (isset($_POST["address"]) && $_POST["address"] != "")) {
        
        $name = $_POST["name"];
        $telephone = $_POST["telephone"];
        $address = $_POST["address"];

        $doQuery = $conn->prepare("UPDATE users SET name = ?, address = ?, telephone = ? WHERE id = ?");

        if($doQuery->bind_param("sssi", $name, $address, $telephone, $_SESSION["uid"]) && $doQuery->execute()){
            $result = $doQuery->get_result();
            
            if($result === false){

                echo '<script>alert("Data berhasil diupdate!")</script>';

            } else {
                echo '<script>alert("Data gagal diupdate!")<script>';
            }
            
        } else {
            echo '<script>alert("Error!")<script>';
        }
        

    } else if ((isset($_POST["passwordlama"]) && $_POST["passwordlama"] != "") && (isset($_POST["passwordbaru"]) && $_POST["passwordbaru"] != "")){
        
        $passwordLama = $_POST["passwordlama"];
        $passwordBaru = password_hash($_POST["passwordbaru"], PASSWORD_DEFAULT);

        $doQuery = $conn->prepare("SELECT * FROM users WHERE id = ?");
        

        if($doQuery->bind_param("i", $_SESSION["uid"]) && $doQuery->execute()){
            $result = $doQuery->get_result();
            
            if($result->num_rows != 0){

                $result = $result->fetch_assoc();

                if(password_verify($passwordLama, $result["password"])){

                    $doQuery = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
                    
                    if($doQuery->bind_param("si", $passwordBaru, $_SESSION["uid"]) && $doQuery->execute()){
                        $result = $doQuery->get_result();
            
                        if($result === false){
                            echo '<script>alert("Password berhasil diupdate!")</script>';
                        } else {
                            echo '<script>alert("Password gagal diupdate!")<script>';
                        }
                        
                    } else {
                        echo '<script>alert("Error!")<script>';
                    }
                    
                } else {
                    echo '<script>alert("Password lama salah!")</script>';
                }
            }
        } else {

            echo '<script>alert("Error!")<script>';
        }

    } else {
        $error = 0;
    }

    $doQuery = $conn->prepare("SELECT * FROM users WHERE id = ?");

    if($doQuery->bind_param("i", $_SESSION["uid"]) && $doQuery->execute()){
    
        $result = $doQuery->get_result();
        $result = $result->fetch_assoc();

    } else {
            echo '<script>alert("Error!")<script>';
    }


?>
<div class="container">
    <div id="account-page" class="row" style="margin-top:120px;margin-bottom:100px">
    <h2>Hello <?php ngecho($result["name"]); ?>!</h2>
    <ul class="collapsible">
        <li>
            <div class="collapsible-header"><i class="material-icons">account_circle</i>My Information</div>
            <div class="collapsible-body">
                
            <div class="row">
                <form class="col s12" method="POST">
                <div class="row">
                    <div class="input-field col s12" style="margin-bottom:0; margin-top:1.5em">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="name" type="text" class="validate" name="name" value="<?php ngecho($result["name"]); ?>">
                        <label for="name">Name</label>
                    </div>
                    <div class="input-field col m6 s12" style="margin-bottom:0;">
                        <i class="material-icons prefix">mail_outline</i>
                        <input disabled id="email" type="email" class="validate" name="email" value="<?php ngecho($result["email"]); ?>">
                        <label for="email">Email</label>
                    </div>
                    <div class="input-field col m6 s12">
                        <i class="material-icons prefix">phone</i>
                        <input id="telephone" type="tel" class="validate" name="telephone" value="<?php ngecho($result["telephone"]); ?>">
                        <label for="telephone">Telephone</label>
                    </div>
                    <div class="input-field col s12" style="margin-top:0;">
                        <i class="material-icons prefix">home</i>
                        <input id="address" type="text" class="validate" name="address" value="<?php ngecho($result["address"]); ?>">
                        <label for="address">Home</label>
                    </div>
                    <div class="input-field col s12" style="margin-top:0;">
                        <button class="waves-effect waves-light btn-small" action="submit">Ubah!</button>
                        </form>
                    </div>
                </div>
                
            </div>
                    
            </div>
        </li>
        <li>
            <div class="collapsible-header"><i class="material-icons">stars</i>My Subscription</div>
            <div class="collapsible-body">
            
            <?php
                if ($result["premium"] == 0){
                    echo '<p>Free Subscription</p>
                        <a href="subscription.php" class="waves-effect waves-light btn-small">Upgrade to Premium!</a>';
                } else {
                    echo '<span>Premium Subscription</span>';
                }
            ?>   
            </div>
        </li>
        <li>
            <div class="collapsible-header"><i class="material-icons">https</i>Password</div>
            <div class="collapsible-body">

              
            <div class="row">
                <form class="col s12" method="POST">
                <div class="row">
                    <div class="input-field col s12" style="margin-bottom:0; margin-top:1.5em">
                        <i class="material-icons prefix">https</i>
                        <input id="passwordlama" type="password" class="validate" name="passwordlama">
                        <label for="passwordlama">Password Lama</label>
                    </div>
                    <div class="input-field col s12" style="margin-bottom:0; margin-top:1.5em">
                        <i class="material-icons prefix">https</i>
                        <input id="passwordbaru" type="password" class="validate" name="passwordbaru">
                        <label for="passwordbaru">Password Baru</label>
                    </div>
                    <div class="input-field col s12">
                        <button class="waves-effect waves-light btn-small">Ubah!</button>
                    </div>
                </div>
                </form>
            </div>

            </div>
        </li>
        <li>
            <div class="collapsible-header"><i class="material-icons">fingerprint</i>My Labs</div>
            <div class="collapsible-body"><span>Work in process..</span></div>
        </li>
        <li>
            <div class="collapsible-header"><i class="material-icons">school</i>My Certificates</div>
            <div class="collapsible-body">
                <?php
                   
                    $doQuery = $conn->prepare("SELECT * FROM users JOIN certificates ON users.id = certificates.userID JOIN courses ON certificates.courseID = courses.courseID WHERE users.id = ?");

                    if($doQuery->bind_param("i", $_SESSION["uid"]) && $doQuery->execute()){
                        
                        $result = $doQuery->get_result();

                    } else {
                        echo '<script>alert("Error!")<script>';
                    }

                    if ($result->num_rows > 0 ){
                        while($cert = $result->fetch_assoc()):
                        ?>
                        <ul class="collection">
                            <li class="collection-item avatar">
                              <img src="img/<?php echo $cert['courseImage']; ?>" alt="" class="circle">
                              <span class="title"><b><?php echo $cert['courseName']; ?></b></span>
                              <p>Passed this lab on <?php echo date('d  F  Y', strtotime($cert['date'])); ?><br>
                              <a href="certificate.php?certID=<?php echo $cert['certID']; ?>" class="secondary-content"><i class="material-icons">arrow_forward</i></a>
                            </li>   
                        </ul>
                <?php endwhile; 
                    } else {
                      echo "<span>You don't have any certificates yet</span>";  
                    } 

                 ?>
            </div>
        </li>
    </ul>   
    </div>
</div>
<?php include("footer.php") ?>
<script>
    const collapsible = document.querySelectorAll('.collapsible');
    M.Collapsible.init(collapsible);
    
</script>