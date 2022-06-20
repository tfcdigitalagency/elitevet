<script src="https://js.stripe.com/v3/"></script>
<div class="container">
	<h2 class="text-center">Become a Sponsor</h2>
<form action="<?php echo site_url('customer/sponsor/purchase')?>" id="sponsor_form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<div class="modal-body">
		<div class="row form-group">
			<div class="col-md-4">
				<label>Company</label>
			</div>
			<div class="col-md-8">
				<input type="text" class="form-control input" name="company"  placeholder="Company name" required>
			</div>
		</div>
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
		<div class="row form-group">
			<div class="col-md-4">
				<label>Your Phone</label>
			</div>
			<div class="col-md-8">
				<input type="text" class="form-control input" name="phone"  placeholder="Phone number"  required />
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<label>Ads Link</label>
			</div>
			<div class="col-md-8">
				<input type="text" class="form-control input" name="url"  placeholder="URL sponsor"  required />
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<label>Logo/Image</label>
			</div>
			<div class="col-md-8">
				<input type="file" name="userfile" class="input" size="20" style="display: inline-block;"  required />
			</div>
		</div>


		<div class="paymentWrap">
			<h3 class="header-profile">
				<div>
					Payment Info							</div>
			</h3>
			<div class="row">
				<div class="col-md-12">
					<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
					<div id="payment-errors"></div>

					<div class="row form-group">
						<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label">Select Package</label>
						<div class="col-md-8 col-xs-4 col-sm-8 ">
							<select id="selectPackage" name="package_id" class="form-control">
								<?php foreach ($sponsors_package as $p){?>
									<option value="<?php echo $p->id?>" data-cost="<?php echo $p->cost?>" <?php echo ($p->id == $package_id)?'selected':''?>><?php echo $p->name?></option>
								<?php }?>
							</select>
						</div>

					</div>
					<div class="row form-group">
						<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label">Amount</label>

						<div class="col-md-8 col-xs-8 col-sm-8 " id="p_amount"> <label class="control-label">  <span id="display_amount"></span> USD </label>
						</div>
					</div>
					<!--div class="row form-group" id="show_hide_div">
						<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"></label>
						<div class="col-md-8 col-xs-8 col-sm-8 ">
							<button type="button" onclick="show_coupon();" class="btn btn-default center">Have a coupon?</button>
						</div>
					</div-->
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

					<input type="hidden" name="form_reg" id="form_reg" value="">
					<input type="hidden" name="action" value="stripe">



				</div>
			</div>
		</div>

	</div>
	<div class="modal-footer">
		<div id="loading-3" style="display: none;"><img src="https://elitesdvob.org/wp-content/plugins/directory-pro/admin/files/images/loader.gif"></div>
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
		<input type="submit" value="Submit" class="btn btn-primary" id="btn_register_sponsor" />
	</div>
</form>
</div>
<script>
	$('#display_amount').text($('#selectPackage :selected').data('cost'));
	$('#selectPackage').change(function (){
		var t = $('#selectPackage :selected').data('cost');
		$('#display_amount').text(t);
	})
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

<script>
	var validator;

	var FormValidation = function() {
		// Validation config
		var _componentValidation = function() {
			if (!$().validate) {
				console.warn('Warning - validate.min.js is not loaded.');
				return;
			}

			// Initialize
			validator = $('.form-validate-jquery').validate({
				ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
				errorClass: 'validation-invalid-label',
				successClass: 'validation-valid-label',
				validClass: 'validation-valid-label',
				highlight: function(element, errorClass) {
					$(element).removeClass(errorClass);
				},
				unhighlight: function(element, errorClass) {
					$(element).removeClass(errorClass);
				},
				success: function(label) {
					label.addClass('validation-valid-label').text('success.'); // remove to hide Success message
				},

				// Different components require proper error label placement
				errorPlacement: function(error, element) {

					// Unstyled checkboxes, radios
					if (element.parents().hasClass('form-check')) {
						error.appendTo( element.parents('.form-check').parent() );
					}

					// Input with icons and Select2
					else if (element.parents().hasClass('form-group-feedback') || element.hasClass('select2-hidden-accessible')) {
						error.appendTo( element.parent() );
					}

					// Input group, styled file input
					else if (element.parent().is('.uniform-uploader, .uniform-select') || element.parents().hasClass('input-group')) {
						error.appendTo( element.parent().parent() );
					}

					// Other elements
					else {
						error.insertAfter(element);
					}
				},
				rules: {
					name: {
						required: true
					},
					email: {
						required: true
					},
					phone: {
						required: true
					},
					message: {
						required: true
					},
				},
				messages: {
					name: {
						required: 'Please insert your name.'
					},
					email: {
						required: 'Please insert your email.'
					},
					phone: {
						required: 'Please insert your phone number.'
					},
					message: {
						required: 'Please insert your message.'
					},
				}
			});
		};

		return {
			init: function() {
				_componentValidation();
			}
		}
	}();

	document.addEventListener('DOMContentLoaded', function() {
		FormValidation.init();
	});

	function send_message(){
		var check = validator.checkForm();

		if (!check)
			validator.showErrors();
		else{
			$.ajax({
				url: base_url+'customer/contact/insert_Contact',
				type : 'POST',
				data : {
					name: $('#name').val(),
					phone: $('#phone').val(),
					email: $('#email').val(),
					content:$('#message').val(),
				},
				cache: false,
				success: function(result) {

					new PNotify({
						title: 'SUCCESS!',
						text: 'We received your message and we will get back to you soon.',
						icon: 'icon-checkmark3',
						type: 'success'
					});
					location.reload();
				}
			});
		}
	}

</script>

