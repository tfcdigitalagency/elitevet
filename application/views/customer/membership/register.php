<!-- Stripe JavaScript library -->
<script src="https://js.stripe.com/v3/"></script>
<div class="bootstrap-wrapper">
    <div id="iv-form3" class="sign-up-wizard" style="max-width: 600px; margin: auto;">
        <h3 class="header-profile">
            <div>
                User Info			</div>
        </h3>
        <form id="iv_directories_registration" name="iv_directories_registration" class="form-horizontal has-validation-callback" action="<?php echo site_url('customer/membership/purchase/'.$package->id)?>" method="post" role="form">
            <input type="hidden" name="payment_gateway" id="payment_gateway" value="stripe">
            <input type="hidden" name="iv-submit-stripe" id="iv-submit-stripe" value="register">
            <div class="row">
                <div class="col-md-12 ">
                    <div>
                        <div id="selected-column-1" class=" ">
                            <div class="text-center" id="loading"> </div>
                            <div class="form-group row">
                                <label for="text" class="col-md-4 control-label">
                                    User Name										<span class="chili"></span></label>
                                <div class="col-md-8">
                                    <input type="text" name="name" data-validation="length alphanumeric" data-validation-length="4-12" data-validation-error-msg=" The user name has to be an alphanumeric value between 4-12 characters" class="form-control ctrl-textbox" placeholder="Enter User Name" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 control-label">
                                    Email Address										<span class="chili"></span></label>
                                <div class="col-md-8">
                                    <input type="email" name="email" data-validation="email" class="form-control ctrl-textbox" placeholder="Enter email address" data-validation-error-msg="Please enter a valid email address " required>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label for="text" class="col-md-4 control-label">
                                    Password										<span class="chili"></span></label>
                                <div class="col-md-8">
                                    <input type="password" name="password" class="form-control ctrl-textbox" placeholder="" data-validation="strength" data-validation-strength="2" data-validation-error-msg="The password is not strong enough">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <h3 class="header-profile">
                <div>
                    Payment Info							</div>
            </h3>
            <div class="row">
                <div class="col-md-12">
                    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
                    <div id="payment-errors"></div>

                    <div class="row form-group">
                        <label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label">Package Name</label>
                        <div class="col-md-8 col-xs-4 col-sm-8 ">
                            <label class="control-label"> <?php echo $package->name;?></label>											</div>

                    </div>
                    <div class="row form-group">
                        <label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label">Amount</label>

                        <div class="col-md-8 col-xs-8 col-sm-8 " id="p_amount"> <label class="control-label">  <?php echo $package->cost;?> USD </label>
                        </div>
                    </div>
                    <div class="row form-group" id="show_hide_div">
                        <label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"></label>
                        <div class="col-md-8 col-xs-8 col-sm-8 ">
                            <button type="button" onclick="show_coupon();" class="btn btn-default center">Have a coupon?</button>
                        </div>
                    </div>
                    <div id="coupon-div" style="display: none;">
                        <div class="row form-group">
                            <label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label">Discount Coupon</label>

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

                    <input type="hidden" name="package_id" id="package_id" value="<?php echo $package->id?>">
                    <input type="hidden" name="form_reg" id="form_reg" value="">
                    <input type="hidden" name="action" value="stripe">

                    <div class="row form-group">
                        <label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"></label>
                        <div class="col-md-8 col-xs-8 col-sm-8 ">
                            <div id="loading-3" style="display: none;"><img src="https://elitesdvob.org/wp-content/plugins/directory-pro/admin/files/images/loader.gif"></div>
                            <button id="submit_iv_directories_payment" type="submit" class="btn btn-secondary"> Submit </button>
                        </div>
                    </div>




                </div>
            </div>
        </form>
        <div style="display: none;"> <img src="https://elitesdvob.org/wp-content/plugins/directory-pro/admin/files/images/loader.gif"> </div>
    </div>
</div>
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
    var form = document.getElementById('iv_directories_registration');

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