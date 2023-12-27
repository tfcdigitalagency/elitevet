<div id="iv-form3" class="sign-up-wizard" style="max-width: 600px; margin: auto;padding-top:50px;padding-bottom:50px;">
<?php if(!empty($order)){ ?>
    <!-- Display transaction status -->
    <?php 
	//print_r($order);
	if($order['payment_status'] == 'succeeded'){ ?>
        <h1 class="success">Your Payment has been Successful!</h1>
    <?php }else{ ?>
        <h1 class="error">The transaction <?php echo $order['payment_status']?>!</h1>
    <?php } ?>

    <h4>Payment Information</h4>
    <p><b>Reference Number:</b> <?php echo $order['id']; ?></p>
    <p><b>Transaction ID:</b> <?php echo $order['txn_id']; ?></p>
    <p><b>Paid Amount:</b> <?php echo $order['paid_amount'].' '.$order['paid_amount_currency']; ?></p>
    <p><b>Payment Status:</b> <?php echo $order['payment_status']; ?></p>

    <h4 style="margin-top:30px; ">Package Information</h4>
    <p><b>Name:</b> <?php echo $order['name']; ?></p>
    <p><b>Price:</b> <?php echo $order['cost'].' '.$order['paid_amount_currency']; ?></p>
    <p><b>Interval:</b> Yearly</p>
    <p><b>Register date:</b> <?php echo $order['created']?></p>
<?php }else{ ?>
    <h1 class="error">The transaction has failed</h1>
<?php } ?>
</div>
