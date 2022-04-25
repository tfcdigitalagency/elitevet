<div data-elementor-type="wp-page" data-elementor-id="10" class="elementor elementor-10" data-elementor-settings="[]">
    <div class="elementor-inner">
        <div class="elementor-section-wrap">
            <div class="content-wrapper">
                <!-- Content area -->
                <div class="content">

                    <!-- Layout 1 -->
                    <div class="mb-3">
                        <h1 class="mb-0 font-weight-semibold" style="color:red">
                            EliteNCDVeterans
                        </h1>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <div class="card-img-actions mb-3">
                                                    <img class="card-img img-fluid" src="<?=base_url().'assets/global_assets/'?>images/placeholders/thumbnail.png" style="height: 500px" alt="image">
                                                    <div class="card-img-actions-overlay card-img">
                                                        <a href="blog_single.html" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round">
                                                            <i class="icon-link"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1"></div>
                                            <div class="col-md-3" style="margin-top: 140px;"> 
                                                <div class="form-group">
                                                    <span class="btn btn-warning btn-block">Welcome Back!</span>
                                                </div>
                                                <form id="login_form" action="<?=base_url('auth/login')?>" method="post">
                                                    <div class="errMsg" style="margin-bottom: 1rem;"></div>
                                                    <div class="form-group form-group-feedback form-group-feedback-left">
                                                        <input type="text" class="form-control border-success" placeholder="Please input Email" id="email" name="email">                                                    
                                                    </div>
                                                    <div class="form-group form-group-feedback form-group-feedback-left">
                                                        <input type="password" class="form-control border-success" placeholder="Please input Password" id="password" name="password">
                                                    </div>
                                                </form> 
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <button class="btn btn-primary"  onclick="Link_reg()" style="margin-left: 20%;">Sign up <i class="icon-circle-right2 ml-2"></i></button>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <button class="btn btn-primary"  onclick="check()" style="margin-left: 20%;">Sign in <i class="icon-circle-right2 ml-2"></i></button>
                                                    </div>                                                    
                                                </div>
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
                            EliteNCDVeterans
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
    var base_url = '<?= base_url() ?>';

    var FormValidation = function() {
        // Validation config
        var _componentValidation = function() {
            if (!$().validate) {
                console.warn('Warning - validate.min.js is not loaded.');
                return;
            }

            // Initialize
            validator = $('#login_form').validate({
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
        <?php if (!empty($this->session->userdata('errMsg'))):?>
        msg.html('<div class="alert alert-warning border-0 alert-dismissible">' +
            '<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>' +
            '<span class="font-weight-semibold">This account is not correct!</span></div>');

        <?php $this->session->unset_userdata('errMsg');?>
        $('#email').val("");
        $('#password').val("");
        <?php endif;?>
    });

    function check() {
        var check = validator.checkForm();

        if (!check)
            validator.showErrors();
        else
            $('#login_form').submit();
    }

    function Link_reg() {
        location.href = base_url+'auth/register';
    }
</script>