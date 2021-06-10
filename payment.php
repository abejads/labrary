<?php $title = "Payment"; ?>
<?php include("header.php"); ?>

<?php 
    
    require_once("include/connection.php"); 
    if(isset($_POST["card_number"]) && (strlen($_POST["card_number"]) >= 16) && isset($_POST["exp_date"]) && (strlen($_POST["exp_date"]) == 5) && isset($_POST["cardvv"]) && (strlen($_POST["cardvv"]) >= 3) && isset($_POST["card_owner"]) && $_POST["card_owner"] != "" && isset($_POST["submit"])){
        
        $card_number = $_POST["card_number"];
        $exp_date = $_POST["exp_date"];
        $cardvv = $_POST["cardvv"];
        $card_owner = $_POST["card_owner"];
        $premium = 1;

        $doQuery = $conn->prepare("UPDATE users SET premium = ? WHERE id = ?");

        if($doQuery->bind_param("ii", $premium, $_SESSION['uid']) && $doQuery->execute()){
            $result = $doQuery->get_result();

            if(!$result){
                $_SESSION["premium"] = 1;
                echo '<script>alert("Pembelian Berhasil!"); window.location = "account.php";</script>';
            } else {
                echo '<script>alert("Pembelian Gagal!"); window.location = "subscription.php";</script>';
            }
            
        } else {
            echo '<script>alert("Error!")<script>';
        }
        

    } else {
        $error = 0;
    }

    
?>
<div class="container">
    <div id="payment" class="row">
        <div class="row">
            <h3 class="center" style="padding-top:30px;">Credit Card Payment</h3>
            <center><img src="http://www.prepbootstrap.com/Content/images/shared/misc/creditcardicons.png" height="auto" width="30%"></img></center></br>
            <h4 class="left">Payment Details</h4>
            <div class="row">
                <form class="col s12" method="POST">
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix small">credit_card</i>
                            <input placeholder="Card Number" id="card_number" type="text" class="validate" name="card_number">
                            <label for="card_number">Card Number</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <i class="material-icons prefix small">date_range</i>
                            <input placeholder="MM/YY" id="exp_date" type="text" class="validate" name="exp_date">
                            <label for="exp_date">Expiration Date</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix small">lock</i>
                            <input placeholder="CVV" id="cardvv" type="password" class="validate" name="cardvv">
                            <label for="cvv">CVV</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix small">person</i>
                            <input placeholder="Card Owner Name" id="card_owner" type="text" class="validate" name="card_owner">
                            <label for="card_owner">Card Owner Name</label>
                        </div>
                    </div>
                    <div class="input-field col s12">
                        <button class="btn waves-effect waves-light col s12" name="submit">Process Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<link href="css/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/materialize.min.js"></script>