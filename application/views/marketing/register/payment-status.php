<style>
 
.about-section {
    position: relative;
}
.padding {
    padding: 40px 0;
}
.circle:before {
    background-color: #f8b864;
    content: '';
    height: 800px;
    width: 800px;
    position: absolute;
    top: -400px;
    left: -350px;
    border-radius: 100%;
    opacity: 0.2;
    z-index: -1;
}
.shape:after {
    background-color: #f8b864;
    content: '';
    width: 50%;
    height: 580px;
    position: absolute;
    top: 330px;
    right: -150px;
    border-radius: 100%;
    -webkit-transform: skew(3deg,30deg);
    -ms-transform: skew(3deg,30deg);
    transform: skew(5deg,10deg);
    opacity: 0.3;
    z-index: -1;
}

</style>
<main class="clearfix width-100 mt-5"> 

    <div class="section-white mt-3 shape about-section padding circle">
<div id="iv-form3" class="sign-up-wizard" style="max-width: 600px; margin: auto;">
<?php if(!empty($order)){ ?>
    <!-- Display transaction status -->
    <?php if($order['payment_status'] == 'succeeded'){ ?>
        <h2 class="success">Your Payment has been Successful!</h2>
    <?php }else{ ?>
        <h1 class="error">The transaction was successful! But your payment has been failed!</h1>
    <?php } ?>

    <h4>Payment Information</h4>
    <p><b>Reference Number:</b> <?php echo $order['id']; ?></p>
    <p><b>Transaction ID:</b> <?php echo $order['txn_id']; ?></p>
    <p><b>Paid Amount:</b> <?php echo $order['paid_amount'].' '.$order['paid_amount_currency']; ?></p>
    <p><b>Payment Status:</b> <?php echo $order['payment_status']; ?></p> 
	<div style="height:50px"></div>
<?php }else{ ?>
    <h1 class="error">The transaction has failed</h1>
<?php } ?>
	<div style="text-align: center">
		<a class="btn btn-primary" style="padding: 8px 35px; color: #fff" href="<?php echo site_url('marketing/register')?>">Back</a>
	</div>
</div>
</div> 
</main> </div> 
