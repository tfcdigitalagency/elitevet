<!-- Page header -->
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4></i> <span class="font-weight-semibold">Edit Training Video</span></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
<!-- /page header -->

<!-- Content area -->
<div class="content">

    <!-- Basic modals -->
    <div class="card">        
        <div class="card-body">
        	<form class="form-validate-jquery" method="post" target="_other">
        		<input type="text" class="form-control" id="video_id" name="video_id" value="<?php echo $data[0]['id']; ?>" hidden>
	            <div class="form-group row">
					<label class="col-form-label col-lg-2">Title<span class="text-danger">*</span></label>
					<div class="col-lg-10">
						<input type="text" class="form-control" id="title" value="<?php echo $data[0]['title']; ?>" required>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Description</label>
					<div class="col-lg-10">
						<textarea rows="5" cols="3" class="form-control" id="details" placeholder="Please Input Description" ><?php echo $data[0]['details']; ?></textarea>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Video<span class="text-danger">*</span></label>
					<div class="col-lg-10">
						<input type="text" class="form-control" id="link" value="<?php echo $data[0]['video_link']; ?>" required>
					</div>
				</div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">Training Type<span class="text-danger">*</span></label>
                    <div class="col-lg-4">
                        <select class="form-control select" id="training_type" name="training_type" data-fouc>                            
                            <?php foreach ($training_type as $item):?>
                                <option value="<?=$item['id']?>" <?=($item['id'] == $data[0]['training_type'])?'selected':'';?>><?=$item['type']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div> 
				<div class="form-group row" style="float: right;">
					<button type="button" class="btn btn-warning" onclick="backList()">&nbsp&nbspBack&nbsp&nbsp</button>&nbsp&nbsp
					<button type="button" class="btn btn-primary" onclick="save_Training()">&nbsp&nbspSave&nbsp&nbsp</button>
				</div>
			</form>
        </div>
    </div>
    <!-- /basic modals -->

</div>
<!-- /content area -->

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
    
  
    function save_Training() {

    	var check = validator.checkForm();
        if (!check)            
            validator.showErrors();
        else{
            $.ajax({
                url: base_url+'admin/training/insert_Training',
                type : 'POST',
                data : {
                    id: $('#video_id').val(),
                    title: $('#title').val(),
                    details: $('#details').val(),
                    video_link: $('#link').val(),
                    training_type:$('#training_type').val(),
                },
                cache: false,
                success: function(result) {
                    
                    new PNotify({
                        title: 'SUCCESS!',
                        text: 'The Operation is correct.',
                        icon: 'icon-checkmark3',
                        type: 'success'
                    });
                    location.href = base_url+'admin/training/view';
                }
            });
        }
        
    }

     function backList() {
        location.href = base_url+'admin/training/view';
     }

</script>
<iframe name="_other" id="_other" hidden></iframe>




