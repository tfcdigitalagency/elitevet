
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

                    <div class="card-body" style="width: 80%;margin-left: 10%;background-color: khaki;">
						<div class="card-img-actions mx-1 mt-1">
							
							<img class="card-img img-fluid" src="<?=base_url().$data[0]['thumbnail'];?>" alt="" style="width: 80%;margin-left: 10%;height: 400px;">
																
						</div>

						<div class="card-img-actions mx-1 mt-1">
							<div class="form-group row">
								<div class="col-lg-12">
									<div class="row" style="width: 80%;margin-left: 10%;">
										<div class="col-6" style=" height: 64px;border-radius: 10px;margin-left: -10px;margin-top: 10px;color: #000;font-size: large;padding-top: 13px;text-align: center;">
											EliteNVDVeterans <?php echo $data[0]['name'];?>
										</div>
										<div class="col-6" style=" height: 64px;border-radius: 10px;margin-left: 10px;margin-top: 10px;color: #000;font-size: large;padding-top: 13px;text-align: center;">

											Location:<?php echo $data[0]['location'];?>
										</div>
									</div>

                    				<input type="text" class="form-control" id="event_id" value="<?php echo $data[0]['id'];?>" hidden>
									<div class="row" style="width: 80%;margin-left: 10%;">
										<div class="col-6" style=" height: 64px;border-radius: 10px;margin-left: -10px;margin-top: 10px;color: #000;font-size: large;padding-top: 13px;text-align: center;">
											<?php echo $data[0]['start_time'];?>~<?php echo $data[0]['end_time'];?>
										</div>
										<div class="col-6" style=" height: 64px;border-radius: 10px;margin-left: 10px;margin-top: 10px;color: #000;font-size: large;padding-top: 13px;text-align: center;">

											Status:<?php echo $data[0]['status'];?>
										</div>
									</div>
									<div class="row" style="width: 80%;margin-left: 10%;">
										<div class="col-6" style=" height: 64px;border-radius: 10px;margin-left: -10px;margin-top: 10px;color: #000;font-size: large;padding-top: 13px;text-align: center;">
											Registed: <?php echo $registed_count;?> People
										</div>										
									</div>
								</div>
								<div class="col-lg-12">
									<button type="button" class="btn btn-danger" onclick="Reg_Event()" style="float:right;margin-right: 10%; display:<?= ($data[0]['status'] != "upcoming") ?'none':'';?>" >Buy Ticket | Register Event</button>
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

<!-- Success modal -->
<div id="modal_Reg" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h6 class="modal-title" id="modal_Reg_Title">Primary header</h6>
				<button type="button" class="close" data-dismiss="modal">×</button>
			</div>

			<div class="modal-body">
				<form class="form-validate-jquery" method="post" target="_other">
					<div class="form-group row">
						<label class="col-form-label col-lg-2">First Name:</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" id="first_name" placeholder="Enter First Name" required>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-form-label col-lg-2">Last Name:</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" id="last_name" placeholder="Enter Last Name" required>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-form-label col-lg-2">Email:</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" id="email" placeholder="Enter Email" required>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-form-label col-lg-2">Phone:</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" id="phone" placeholder="Enter Phone">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-form-label col-lg-2">Title:</label>
						<div class="col-lg-10">
							<select id="title" name="title" class="form-control">
                            	<option value="Corporate">Corporate</option>
                            	<option value="Veteran">Veteran</option>
                            	<option value="Disabled Vet">Disabled Vet</option>
                            	<option value="Other">Other</option>
                            </select>
							<!-- <input type="text" class="form-control" id="title" placeholder="Enter Title"> -->
						</div>
					</div>
					<div class="form-group row">
						<label class="col-form-label col-lg-2">Company:</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" id="company" placeholder="Enter Company">
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
					<button type="button" class="btn bg-primary" onclick="Save_Reg()">Register</button>
				</div>
			</form>	
		</div>
	</div>
</div>

<!-- /success modal -->

<script> 
    function Display_Detail() {
        location.href = base_url+'auth/register';
    }

    function Reg_Event(){
    	$('#modal_Reg_Title').html("Register Event");
    	validator.resetForm();
        <?php if(!empty($this->session->userdata('user'))):?>
            $('#first_name').val("<?=$this->session->userdata('user')['name']?>");
            $('#email').val("<?=$this->session->userdata('user')['email']?>");
            $('#phone').val("<?=$this->session->userdata('user')['phone_number']?>");
            $('#title').val("<?=$this->session->userdata('user')['title']?>");
            $('#company').val("<?=$this->session->userdata('user')['company']?>");
        <?php endif;?>
        $('#modal_Reg').modal();
    } 

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
                    label.addClass('validation-valid-label').text('Success'); // remove to hide Success message
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
                    name:{
                        maxlength: 50
                    },
                    description:{
                        maxlength: 512
                    },
                },
                messages: {
                    name: {
                        required: 'This field is required.'
                    },   
                    link: {
                        required: 'This field is required.'
                    }                
                }
            });

            // Reset form
            $('#reset').on('click', function() {
                validator.resetForm();
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

    function Save_Reg() {

    	var check = validator.checkForm();
        if (!check)            
            validator.showErrors();
        else{
            $.ajax({
                url: base_url+'customer/event/insert_RegEvent',
                type : 'POST',
                data : {
                    first_name: $('#first_name').val(),
                    last_name: $('#last_name').val(),
                    email: $('#email').val(),
                    phone: $('#phone').val(),
                    title: $('#title').val(),
                    company: $('#company').val(),
                    event_id:$('#event_id').val()
                },
                cache: false,
                success: function() {
                   
                    //$('#modal_Reg').modal('hide');
                    location.href = base_url+'customer/event/index';
                }
            });
        }
    }
</script>

<iframe name="_other" id="_other" hidden></iframe>