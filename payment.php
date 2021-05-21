<?php $title = "Payment"; ?>
<?php include("header.php"); ?>
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
                            <input placeholder="MM/YY" id="exp_date" type="text" class="validate">
                            <label for="exp_date">Expiration Date</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix small">lock</i>
                            <input placeholder="CVV" id="cardvv" type="password" class="validate">
                            <label for="cvv">CVV</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix small">person</i>
                            <input placeholder="Card Owner Name" id="card_owner" type="text" class="validate">
                            <label for="card_owner">Card Owner Name</label>
                        </div>
                    </div>
                    <div class="input-field col s12">
                        <button class="btn waves-effect waves-light col s12">Process Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<link href="css/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/materialize.min.js"></script>