<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.css" integrity="sha512-YdYyWQf8AS4WSB0WWdc3FbQ3Ypdm0QCWD2k4hgfqbQbRCJBEgX0iAegkl2S1Evma5ImaVXLBeUkIlP6hQ1eYKQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.js" integrity="sha512-RCgrAvvoLpP7KVgTkTctrUdv7C6t7Un3p1iaoPr1++3pybCyCsCZZN7QEHMZTcJTmcJ7jzexTO+eFpHk4OCFAg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Page header -->
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><span class="font-weight-semibold">Detail Contract</span></h4>
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
			<form autocomplete="off"  enctype="multipart/form-data" class="form-validate-jquery" action="<?php echo site_url("postbid/insert/".$hash);?>" method="post">
				<input type="text" class="form-control" id="contract_id" name="contract_id" value="<?php echo $data['id']; ?>" hidden>
				<input type="text" class="form-control" id="hash" name="hash" value="<?php echo $hash; ?>" hidden>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Opportunity Title<span class="text-danger">*</span></label>
					<div class="col-lg-10">
						<input type="text" class="form-control" id="title" name="title" value="<?php echo $data['title']; ?>" >
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Description</label>
					<div class="col-lg-10">
						<textarea rows="5" cols="3" class="form-control" id="details" name="details" placeholder="Please Input Description" ><?php echo $data['details']; ?></textarea>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Company<span class="text-danger">*</span></label>
					<div class="col-lg-10">
						<input type="text" class="form-control" id="company" name="company" value="<?php echo $sponsor->company; ?>" placeholder="Please input company name" >
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Company Type</label>
					<div class="col-lg-4" style="float: right">
						<select  class="form-control" id="company_type" name="company_type" >
							<option value="">Select</option>
							<?php foreach($company_type as $type){
								?>
								<option <?php echo ($type['id'] == $data['company_type'])?'selected':'' ?> value="<?php echo $type['id']?>"><?php echo $type['title']?></option>
								<?php
								
							}?>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Name<span class="text-danger">*</span></label>
					<div class="col-lg-10">
						<input type="text" class="form-control" id="name" name="name" value="<?php echo $sponsor->name; ?>" placeholder="Please enter Name" >
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Email<span class="text-danger">*</span></label>
					<div class="col-lg-10">
						<input type="email" class="form-control" id="email" name="email" value="<?php echo $sponsor->email; ?>" placeholder="Please enter Email" >
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Phone</label>
					<div class="col-lg-10">
						<input type="text" class="form-control" id="phone" name="phone" value="<?php echo $sponsor->phone; ?>" placeholder="Please enter Phone number" >
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Sponsor</label>
					<div class="col-lg-10">
						<input type="text" class="form-control" id="sponsor" name="sponsor" value="<?php echo $sponsor->url; ?>" placeholder="Website Link" >
					</div>
				</div> 
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Thumbnail</label>
					<div class="col-lg-6" id="image_">
						<input type="file" name="thumbnail" id="thumbnail">
					</div>
					 
					<img width="100" height="100" src ="<?php echo base_url().$sponsor->icon;?>"/>
					 			 
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Include attachment (PDF/JPG</label>
					<div class="col-lg-6" id="second_image_">
						<input type="file" name="second_thumbnail" id="second_thumbnail">
					</div>
					<?php if($data['second_thumbnail']){?>
					<img width="100" height="100" src ="<?php echo base_url().$data['second_thumbnail'];?>"/>
					<?php }?>
				</div>  
				<?php echo $data['start_date']; ?>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Post Start Date<span class="text-danger">*</span></label>
					<div class="col-lg-10">
						<input type="text" autocomplete="off"  class="form-control pickadate" value="<?php echo date("m/d/Y"); ?>"  id="start_date" name="start_date" placeholder="">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Post End Date<span class="text-danger">*</span></label>
					<div class="col-lg-10">
						<input type="text" autocomplete="off"  class="form-control pickadate" id="end_date" name="end_date" value="<?php echo $data['end_date']; ?>" placeholder="">
					</div>
				</div>
				
				<div class="form-group row" style="float: right;">					
					<button type="submit" class="btn btn-primary">&nbsp&nbspSave&nbsp&nbsp</button>
				</div>
			</form>

        </div>
    </div>
    <!-- /basic modals -->
	<script>
		$('.pickadate').datepicker();
	</script>
</div>
<!-- /content area -->

<script>

    var base_url = '<?= base_url() ?>';
    var validator;
    var thumbnail='<?php echo $data['thumbnail']; ?>';
    var second_thumbnail='<?php echo $data['second_thumbnail']; ?>';
    var modalTemplate;
    var previewZoomButtonClasses;
    var previewZoomButtonIcons;
    var fileActionSettings;

    // Bootstrap file upload
    var _componentFileUpload = function() {
        if (!$().fileinput) {
            console.warn('Warning - fileinput.min.js is not loaded.');
            return;
        }

        //
        // Define variables
        //

        // Modal template
        modalTemplate = '<div class="modal-dialog modal-lg" role="document">\n' +
            '  <div class="modal-content">\n' +
            '    <div class="modal-header align-items-center">\n' +
            '      <h6 class="modal-title">{heading} <small><span class="kv-zoom-title"></span></small></h6>\n' +
            '      <div class="kv-zoom-actions btn-group">{toggleheader}{fullscreen}{borderless}{close}</div>\n' +
            '    </div>\n' +
            '    <div class="modal-body">\n' +
            '      <div class="floating-buttons btn-group"></div>\n' +
            '      <div class="kv-zoom-body file-zoom-content"></div>\n' + '{prev} {next}\n' +
            '    </div>\n' +
            '  </div>\n' +
            '</div>\n';

        // Buttons inside zoom modal
        previewZoomButtonClasses = {
            toggleheader: 'btn btn-light btn-icon btn-header-toggle btn-sm',
            fullscreen: 'btn btn-light btn-icon btn-sm',
            borderless: 'btn btn-light btn-icon btn-sm',
            close: 'btn btn-light btn-icon btn-sm'
        };

        // Icons inside zoom modal classes
        previewZoomButtonIcons = {
            prev: '<i class="icon-arrow-left32"></i>',
            next: '<i class="icon-arrow-right32"></i>',
            toggleheader: '<i class="icon-menu-open"></i>',
            fullscreen: '<i class="icon-screen-full"></i>',
            borderless: '<i class="icon-alignment-unalign"></i>',
            close: '<i class="icon-cross2 font-size-base"></i>'
        };

        // File actions
        fileActionSettings = {
            zoomClass: '',
            zoomIcon: '<i class="icon-zoomin3"></i>',
            dragClass: 'p-2',
            dragIcon: '<i class="icon-three-bars"></i>',
            removeClass: '',
            removeErrorClass: 'text-danger',
            removeIcon: '<i class="icon-bin"></i>',
            indicatorNew: '<i class="icon-file-plus text-success"></i>',
            indicatorSuccess: '<i class="icon-checkmark3 file-icon-large text-success"></i>',
            indicatorError: '<i class="icon-cross2 text-danger"></i>',
            indicatorLoading: '<i class="icon-spinner2 spinner text-muted"></i>'
        };

        $('#image').fileinput({
            browseLabel: 'Search',
            browseIcon: '<i class="icon-file-plus mr-2"></i>',
            uploadIcon: '<i class="icon-file-upload2 mr-2"></i>',
            removeIcon: '<i class="icon-cross2 font-size-base mr-2"></i>',
            layoutTemplates: {
                icon: '<i class="icon-file-check"></i>',
                modal: modalTemplate
            },
        });

        $('#second_image').fileinput({
            browseLabel: 'Search',
            browseIcon: '<i class="icon-file-plus mr-2"></i>',
            uploadIcon: '<i class="icon-file-upload2 mr-2"></i>',
            removeIcon: '<i class="icon-cross2 font-size-base mr-2"></i>',
            layoutTemplates: {
                icon: '<i class="icon-file-check"></i>',
                modal: modalTemplate
            },
        });
    };

    jQuery(document).ready(function() {
         

    });

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
                    sponsor: {
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
 

	function checkURLImage(url) {
		return(url.match(/\.(jpeg|jpg|gif|png)$/) != null);
	}

</script>
<iframe name="_other" id="_other" hidden></iframe>




