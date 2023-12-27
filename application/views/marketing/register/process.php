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

.titlePack{
	font-weight: bold;
}
.btn_register{
	max-width:300px;
	margin: auto;
}
.option_flex{
	display: flex;
}
.note{
	font-size: 0.8em;
	color: #999;
}
.wrapper-card {
	display: flex;
	flex-wrap: nowrap;
	margin: 40px auto;
	width: 77%;
}

.card {
	background: #fff;
	border-radius: 3px;
	box-shadow: 0 1px 1px rgba(0, 0, 0, 0);
	flex: 1;
	margin: 8px;
	padding: 30px;
	position: relative;
	text-align: center;
	transition: all 0.5s ease-in-out;
}
.card.popular {
	margin-top: -10px;
	margin-bottom: -10px;
}
.card.popular .card-title h3 {
	color: #3498db;
	font-size: 22px;
}
.card.popular .card-price {
	margin: 30px;
}
.card.popular .card-price h1 {
	color: #3498db;
	font-size: 60px;
}
.card.popular .card-action button {
	background-color: #3498db;
	border-radius: 80px;
	color: #fff;
	font-size: 17px;
	margin-top: -5px;
	padding: 15px;
	height: 60px;
}
.card.popular .card-action button:hover {
	background-color: #2386c8;
	font-size: 23px;
}
.card:hover {
	box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
}

.card-ribbon {
	position: absolute;
	overflow: hidden;
	top: -10px;
	left: -10px;
	width: 114px;
	height: 112px;
}
.card-ribbon span {
	position: absolute;
	display: block;
	width: 160px;
	padding: 10px 0;
	background-color: #3498db;
	box-shadow: 0 5px 5px rgba(0, 0, 0, 0.2);
	color: #fff;
	font-size: 13px;
	text-transform: uppercase;
	text-align: center;
	left: -35px;
	top: 25px;
	transform: rotate(-45deg);
}
.card-ribbon::before, .card-ribbon::after {
	position: absolute;
	z-index: -1;
	content: "";
	display: block;
	border: 5px solid #2980b9;
	border-top-color: transparent;
	border-left-color: transparent;
}
.card-ribbon::before {
	top: 0;
	right: 0;
}
.card-ribbon::after {
	bottom: 0;
	left: 0;
}

.card-title h3 {
	color: rgba(0, 0, 0, 0.3);
	font-size: 20px;
	text-transform: uppercase;
}
.card-title h4 {
	color: rgba(0, 0, 0, 0.6);
}

.card-price {
	margin: 20px 0;
}
.card-price h1 {
	font-size: 46px;
}
.card-price h1 sup {
	font-size: 15px;
	display: inline-block;
	margin-left: -20px;
	width: 10px;
}
.card-price h1 small {
	color: rgba(0, 0, 0, 0.3);
	display: block;
	font-size: 11px;
	text-transform: uppercase;
}

.card-description ul {
	display: block;
	list-style: none;
	margin: 10px 0;
	padding: 0;
}
.card-description li {
	color: rgba(0, 0, 0, 0.6);
	font-size: 15px;
	margin: 0 0 15px;
}
.option_label{ font-weight: bold }
.card-description li div.option_label::before {
	content: "✔";
	padding: 0 5px 0 0;
	color: green;
}
.card-description li div.option_label_x::before {
	content: "✘";
	padding: 0 5px 0 0;
	color: red;
}

.card-action button {
	background: transparent;
	border: 2px solid #3498db;
	border-radius: 30px;
	color: #3498db;
	cursor: pointer;
	display: block;
	font-size: 15px;
	font-weight: bold;
	padding: 10px;
	width: 100%;
	text-transform: uppercase;
	transition: all 0.3s ease-in-out;
}
.card-action button:hover {
	background-color: #3498db;
	box-shadow: 0 2px 4px #196090;
	color: #fff;
	font-size: 17px;
}
.toggler-wrapper {
	display: block;
	width: 45px;
	height: 25px;
	cursor: pointer;
	position: relative;
}

.toggler-wrapper input[type="checkbox"] {
	display: none;
}

.toggler-wrapper input[type="checkbox"]:checked+.toggler-slider {
	background-color: #44cc66;
}

.toggler-wrapper .toggler-slider {
	background-color: #ccc;
	position: absolute;
	border-radius: 100px;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	-webkit-transition: all 300ms ease;
	transition: all 300ms ease;
}

.toggler-wrapper .toggler-knob {
	position: absolute;
	-webkit-transition: all 300ms ease;
	transition: all 300ms ease;
}


.toggler-wrapper.style-1 input[type="checkbox"]:checked+.toggler-slider .toggler-knob {
	left: calc(100% - 19px - 3px);
}

.toggler-wrapper.style-1 .toggler-knob {
	width: calc(25px - 6px);
	height: calc(25px - 6px);
	border-radius: 50%;
	left: 3px;
	top: 3px;
	background-color: #fff;
}

</style>

<?php
//print_r($postData)
?>

<main class="clearfix width-100 mt-3">
    <div class="section-white mt-3 shape about-section padding circle">
                    <div class="container">
						<div class="text-center">
						<?php
						$detail = json_decode($packages['detail'], true);
						$unit = $packages['unit'];
						$basic = $packages['price'];
						$total = $basic;

						$postDataOption  = $postData['custom_options'];
						if(!$postDataOption) $postDataOption = array();
						foreach ($postDataOption as $k=>$v) {
							$postDataOption[$k] = json_decode(base64_decode($v), true);
						}


						foreach ($detail as $key => $value){
							if($value['require'] || in_array($value, $postDataOption)){
								$total += floatval($value['price']);
							}
						}
						?>
							<div class="row">
								<div class="col-md-12">
									<h1>Payment Process</h1>
								</div>
								<div class="col-md-6">
									<div class="card card_package">

										<div class="card-title">
											<input type="hidden" name="pack_id" value="<?php echo $packages['id']?>">
											<input type="hidden" name="total" class="total" value="<?php echo $total?>">
											<input type="hidden" class="unitPrice" value="<?php echo floatval($basic)?>">
											<h3 class="titlePack"><?php echo $packages['pack_name']?></h3>
											<h4><?php echo $packages['description']?></h4>
										</div>
										<div class="card-price">
											<h1>
												<sup>$</sup>
												<span class="total"><?php echo $total?></span>
												<?php if($unit){?><small>month</small><?php }?>
											</h1>
										</div>
										<div class="card-description">
											<?php if(!empty($detail)){?>
												<ul>

													<?php
													foreach ($detail as $key => $opt){?>
														<li data-price="<?php echo $opt['price']?>">
															<?php if($opt['require'] || in_array($opt, $postDataOption)){?>
																<div class="option_label"><?php echo $opt['options']?></div>
																<?php
															}else{?>
																<div class="option_label_x"><strike><?php echo $opt['options']?></strike></div>
															<?php }?>
															<?php if($opt['note']){?>
																<div class="note"><?php echo $opt['note']?></div>
															<?php }?>
														</li>
													<?php }?>
												</ul>
											<?php }?>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="text-center mt-3">
										<img width="250" style="margin:auto;" src="/assets/card.jpg"/>
									</div>
									<div class="row">

										<div class="mt-3 mb-3 col-md-12 paymentWrap">
											<form action="<?php echo site_url('marketing/register/registerPack')?>" id="sponsor_form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
												<input type="hidden" name="data" value="<?php echo base64_encode(json_encode($postData))?>">
												<div class="row">
													<div class="col-md-12">
														<script src="https://js.stripe.com/v3/"></script>
														<div id="payment-errors"></div>

														<input type="hidden" id="donate_total_amount" value="<?php echo $total?>" name="cost"/>


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

														<div id="coupon-div" style="display: none;">
															<div class="row form-group">
																<label for="text" class="col-md-3 col-xs-4 col-sm-4 control-label">Discount Coupon</label>

																<div class="col-md-6 col-xs-6 col-sm-6 ">  <input type="text" class="form-control" name="coupon_name" id="coupon_name" value="" placeholder="Enter Coupon Code">
																</div>
																<div class="col-md-1 col-xs-1 col-sm-1 pull-left" id="coupon-result">
																</div>
															</div>
															<div class="row">
																<hr>
															</div>
															<div class="row">
																<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label">(-) Discount</label>

																<div class="col-md-8 col-xs-8 col-sm-8 " id="discount">
																</div>
															</div>
															<div class="row">
																<hr>
															</div>
															<div class="row">
																<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label">Total</label>

																<div class="col-md-8 col-xs-8 col-sm-8" id="total"><label class="control-label">  200 USD</label>
																</div>
															</div>

															<div class="row">
																<hr>

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
																<input type="submit" value="Pay Now" class="btn btn-primary" style="font-size: 22px; padding: 10px 25px;" />
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

						 </div>

                    </div>
     </div>
 
</main>  <!-- #main -->
<script>
	
	$('.donateAmount').click(function(){
		$('.selectedAmount').removeClass('selectedAmount');
		var val = $(this).data('amount');
		
		if(val == 'other'){
			$('#donate_amount').attr('type','number')
			$('#donate_amount').attr('min','51');
			val = 0;
			 
		}else{
			$('#donate_amount').val(val);
			$('#donate_amount').attr('type','hidden')
			$('#donate_amount').attr('min','0')
		}
		
		$(this).addClass('selectedAmount');
		
		updateFee();
		
	});
	
	$('#donate_amount').change(function(){
		updateFee();
	});
	
	$('#cover_fee').click(function(){
		updateFee();
	});
	
	function updateFee(){
		var v = $('#donate_amount').val();
		var ammount = parseFloat(v);
		if(v>0){ 
		
			var charge_data = calcFee(ammount, 'USD');
			var fee = charge_data.fee;
			
		}else{ 
			var fee = 0;
		}
		 
		$('#display_cover_fee').text(fee);
		if($('#cover_fee').is(':checked')){
			 
			$('#donate_total_amount').val(parseFloat(ammount)+parseFloat(fee));
		}else{
			$('#donate_total_amount').val(ammount);
		}
		
	}
	
	
	var fees = { 
		USD: { Percent: 2.9, Fixed: 0.30 },
		GBP: { Percent: 2.4, Fixed: 0.20 },
		EUR: { Percent: 2.4, Fixed: 0.24 },
		CAD: { Percent: 2.9, Fixed: 0.30 },
		AUD: { Percent: 2.9, Fixed: 0.30 },
		NOK: { Percent: 2.9, Fixed: 2 },
		DKK: { Percent: 2.9, Fixed: 1.8 },
		SEK: { Percent: 2.9, Fixed: 1.8 },
		JPY: { Percent: 3.6, Fixed: 0 },
		MXN: { Percent: 3.6, Fixed: 3 }
	};

	function calcFee(amount, currency) {
		var _fee = fees[currency];
		var amount = parseFloat(amount);
		var total = (amount + parseFloat(_fee.Fixed)) / (1 - parseFloat(_fee.Percent) / 100);
		var fee = total - amount;

		return {
			amount: amount,
			fee: fee.toFixed(2),
			total: total.toFixed(2)
		};
	}

	 
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
