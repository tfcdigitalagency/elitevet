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

.selectAmount{ position:relative;}
.selectAmount .donateAmount{
	cursor:pointer;
	font-size:1.8em;
	text-align:center;
	width:80px;
	border:1px solid #ccc;
	border-radius:8px;
	display:inline-block;
	padding:10px 5px;
	background:#fff;
}
.selectAmount .donateAmount:hover,
.selectedAmount{
	background:#185EAC!important;
	color:#fff!important;
}
</style>
<main class="clearfix width-100 mt-5">
     
	<?php  
	//print_r($package);
	if($package){
	?>	
    <div class="section-white mt-3 shape about-section padding circle">
                    <div class="container">
						<div class="text-center">
                         <h1>SPONSOR INVOICE - <?php echo strtoupper($package->name)?></h1>
						 <?php echo $package->details?>
						 </div>
						 <div class="text-center mt-3">
							<img width="250" style="margin:auto;" src="/assets/card.jpg"/>
						 </div>
						 <div class="row">
						 
						 <div class="mt-3 mb-3 col-md-8 offset-md-2 paymentWrap">
					<form action="<?php echo site_url('customer/sponsor/pay_invoice')?>" id="sponsor_form" enctype="multipart/form-data" method="post" accept-charset="utf-8"> 
					<div class="row">
						<div class="col-md-12">
							<script src="https://js.stripe.com/v3/"></script>
							<div id="payment-errors"></div>

							<div class="row form-group">
								<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label">Amount</label>
								<div class="col-md-8 col-xs-4 col-sm-8 ">
									<h2>$<?php
										echo $package->cost;
									?></h2>								 
								</div>

							</div>
							<input type="hidden" id="total_amount" value="<?php echo $package->cost; ?>" name="total_amount"/>
							<input type="hidden" id="package" value="<?php echo $package->id; ?>" name="package"/>
							<div class="row form-group">
					<div class="col-md-4">
						<label>Your Name</label>
					</div>
					<div class="col-md-8">
						 <input type="text" class="form-control input" name="fullname"  placeholder="Name"  required />
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-4">
						<label>Email</label>
					</div>
					<div class="col-md-8">
						 <input type="email" class="form-control input" name="email"  placeholder="Email"  required />
					</div>
				</div> 

							<div class="" id="paymentResponse" style="color: red; margin: 10px 0;">
								<?php echo $this->session->flashdata('error');?>
							</div>

							<div class="row form-group">
								<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label">Card Number</label>
								<div class="col-md-8 col-xs-8 col-sm-8 ">
									<div id="card_number" class="form-control ctrl-textbox"></div>
								</div>
							</div>
							<div class="row form-group">
								<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label">Card CVV </label>
								<div class="col-md-8 col-xs-8 col-sm-8 ">
									<div id="card_cvc" class="form-control ctrl-textbox"></div>
								</div>
							</div>
							<div class="row form-group">
								<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label">Expiration (MM/YYYY)</label>
								<div class="col-md-4 col-xs-4 col-sm4">
									<div id="card_expiry" class="form-control ctrl-textbox"></div>
								</div>
							</div>
							
							<div class="row form-group">
								<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"></label>
								<div class="col-md-4 col-xs-4 col-sm4">
									<input type="submit" value="Pay now" class="btn btn-primary" />
								</div>
							</div>

							<input type="hidden" name="form_reg" id="form_reg" value="">
							<input type="hidden" name="action" value="stripe">

						</div>
					</div>
					</form>
				</div>
				</div>
                    </div>
     </div>
	<?php
	}else{
	?>
	<h2 style="color:red;text-align:center">Invalid data.</h2>
	<div style="height:200px;"></div>
	<?php	
	}
	?>
</main>  <!-- #main -->
<script>
	// Create an instance of the Stripe object
	// Set your publishable API key
	var stripe = Stripe('<?php echo $this->config->item('stripe_publishable_key'); ?>');

	// Create an instance of elements
	var elements = stripe.elements();

	var style = {
		base: {
			fontWeight: 400,
			fontFamily: 'Roboto, Open Sans, Segoe UI, sans-serif',
			fontSize: '16px',
			lineHeight: '1.4',
			color: '#555',
			backgroundColor: '#fff',
			'::placeholder': {
				color: '#888',
			},
		},
		invalid: {
			color: '#eb1c26',
		}
	};

	var cardElement = elements.create('cardNumber', {
		style: style
	});
	cardElement.mount('#card_number');

	var exp = elements.create('cardExpiry', {
		'style': style
	});
	exp.mount('#card_expiry');

	var cvc = elements.create('cardCvc', {
		'style': style
	});
	cvc.mount('#card_cvc');

	// Validate input of the card elements
	var resultContainer = document.getElementById('paymentResponse');
	cardElement.addEventListener('change', function(event) {
		if (event.error) {
			resultContainer.innerHTML = '<p>'+event.error.message+'</p>';
		} else {
			resultContainer.innerHTML = '';
		}
	});

	// Get payment form element
	var form = document.getElementById('sponsor_form');

	// Create a token when the form is submitted.
	form.addEventListener('submit', function(e) {
		e.preventDefault();
		createToken();
	});

	// Create single-use token to charge the user
	function createToken() {
		stripe.createToken(cardElement).then(function(result) {
			if (result.error) {
				// Inform the user if there was an error
				resultContainer.innerHTML = '<p>'+result.error.message+'</p>';
			} else {
				// Send the token to your server
				stripeTokenHandler(result.token);
			}
		});
	}

	// Callback to handle the response from stripe
	function stripeTokenHandler(token) {
		// Insert the token ID into the form so it gets submitted to the server
		var hiddenInput = document.createElement('input');
		hiddenInput.setAttribute('type', 'hidden');
		hiddenInput.setAttribute('name', 'stripeToken');
		hiddenInput.setAttribute('value', token.id);
		form.appendChild(hiddenInput);

		// Submit the form
		form.submit();
	}
</script>