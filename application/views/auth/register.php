<div data-elementor-type="wp-page" data-elementor-id="10" class="elementor elementor-10" data-elementor-settings="[]">
    <div class="elementor-inner">
        <div class="elementor-section-wrap">
            <div class="content-wrapper">
                <!-- Content area -->
                <div class="container">

                    <!-- Layout 1 -->
                    <div class="mb-3">
                        <h1 class="mb-0 font-weight-semibold" >

                        </h1>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body" style="padding: 0!important;">

                                        <div class="row">
                                            <div class="col-md-6 bg_register">

                                            </div>
                                            <div class="col-md-1"></div>
                                            <div class="col-md-4" style="margin-top: 140px;">
                                                <form class="login-form" action="<?=base_url('auth/register')?>" method="post"> 
                                                    <div class="form-group">
                                                        <button class="btn btn-warning btn-block">Register to EliteNCDVeterans</button>
                                                    </div>                                              
                                                    <div class="errMsg" style="margin-bottom: 1rem;"></div>
                                                    
                                                    <div class="form-group">
                                                        <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Enter First Name" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Enter Last Name" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" name="phone_number" class="form-control" id="phone" placeholder="Enter Phone">
                                                    </div>
                                                    <div class="form-group">
                                                        <select id="title" name="title" class="form-control" required>
                                                            <option value="">Title</option>
                                                            <option value="Corporate">Corporate</option>
                                                            <option value="Veteran">Veteran</option>
                                                            <option value="Disabled Vet">Disabled Vet</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" name="company" class="form-control" id="company" placeholder="Enter Company">
                                                    </div>

                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary btn-block" onclick="check()">Sign up<i class="icon-circle-right2 ml-2"></i></button>
                                                    </div>
                                                </form>
                                                <p></p>
                                                <div class="form-group text-center">
                                                    <button type="button" class="btn btn-outline bg-indigo border-indigo text-indigo btn-icon rounded-round border-2"><i class="icon-facebook"></i></button>
                                                    <button type="button" class="btn btn-outline bg-pink-300 border-pink-300 text-pink-300 btn-icon rounded-round border-2 ml-2"><i class="icon-dribbble3"></i></button>
                                                    <button type="button" class="btn btn-outline bg-slate-600 border-slate-600 text-slate-600 btn-icon rounded-round border-2 ml-2"><i class="icon-github"></i></button>
                                                    <button type="button" class="btn btn-outline bg-info border-info text-info btn-icon rounded-round border-2 ml-2"><i class="icon-twitter"></i></button>
                                                </div>
                                            </div>
                                            <div class="col-md-1"></div>

                                        </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /layout 1 -->

                    <div class="mb-3">
                        <h1 class="mb-0 font-weight-semibold" style="color:red">

                        </h1>
                    </div>

                </div>
                <!-- /content area -->
            </div>
        </div>
    </div>
</div>

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
            validator = $('.login-form').validate({
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
                    email: {
                        email: true
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

    jQuery(document).ready(function(){
        var msg = $('.errMsg');
        <?php if (!empty($this->session->userdata('error'))):?>
        msg.html('<div class="alert alert-warning border-0 alert-dismissible">' +
            '<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>' +
            '<span class="font-weight-semibold">This account is already exist!</span></div>');

        <?php $this->session->unset_userdata('error');?>
        $('#email').val("");
        $('#password').val("");
        <?php endif;?>
    });

    function check() {
        var check = validator.checkForm();

        if (!check)
            validator.showErrors();
    }
</script>
