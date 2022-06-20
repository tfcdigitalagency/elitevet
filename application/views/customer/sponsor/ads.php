<div id="iv-form3" class="sign-up-wizard" style="max-width: 600px; margin: auto;">
	<?php if(!empty($ads)){ ?>
		<h1 class="success">Ads Detail</h1>
				<div class="row">
					<div class="col-md-6">
					<p><b>Reference Number:</b> <?php echo $ads->id; ?></p>
					<p><b>Company:</b> <?php echo $ads->company; ?></p>
					<p><b>Name:</b> <?php echo $ads->name; ?></p>
					<p><b>Email:</b> <?php echo $ads->email; ?></p>
					<p><b>Phone:</b> <?php echo $ads->phone; ?></p>
					<p><b>URL:</b> <a href="<?php echo $ads->url; ?>" target="_blank"><?php echo $ads->url; ?></a></p>

					<p><b>Registered:</b> <?php echo $ads->created; ?></p>
					<p><b>Expire date:</b> <?php echo date("Y-m-d H:i:s",strtotime("+ 1 year",strtotime($ads->created))); ?></p>
					</div>
					<div class="col-md-6">
						<img src="<?php echo base_url().$ads->icon?>"  style="max-width: 100%; border: 1px solid #ccc;" />
					</div>
		</div>


	<?php } ?>
<?php if(!empty($order)){ ?>
    <!-- Display transaction status -->

   <h1 class="success">Payment Information</h1>
    <p><b>Reference Number:</b> <?php echo $order['id']; ?></p>
    <p><b>Transaction ID:</b> <?php echo $order['txn_id']; ?></p>
    <p><b>Paid Amount:</b> <?php echo $order['paid_amount'].' '.$order['paid_amount_currency']; ?></p>
    <p><b>Payment Status:</b> <?php echo $order['payment_status']; ?></p>

    <h4 style="margin-top:30px; ">Package Information</h4>
    <p><b>Name:</b> <?php echo $order['name']; ?></p>
    <p><b>Price:</b> <?php echo $order['cost'].' '.$order['paid_amount_currency']; ?></p>
<?php }else{ ?>
    <h1 class="error">The transaction has failed</h1>
<?php } ?>
</div>
