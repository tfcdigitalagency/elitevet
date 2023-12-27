<!-- Page header -->
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><span class="font-weight-semibold">Add New Type</span></h4>
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
			<?php $message = $this->session->flashdata('message');
			if($message){
			?>
			<div style="color:blue;">
				<?php echo $message;?>
			</div>
			<?php }?>
			<div class="row">
			<div class="col-md-7">
        	<form class="form-validate-jquery" id="article_form" method="post" action="<?php echo site_url('admin/company/add')?>">
        		<input type="text" class="form-control" id="article_id" name="article_id" value="" hidden>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Title *</label>
					<div class="col-lg-10">
						<input class="form-control" id="title" name="title" placeholder="Please Input Title" required/>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Images 1</label>
					<div class="col-lg-8" id="image_1">
						<input type="file" class="file-input-overwrite" name="image1" id="image1"  data-fouc>						
					</div>
					<div style="color:#c1c1c1">Size: 300x100 pixel</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Images 2</label>
					<div class="col-lg-8" id="image_2">
						<input type="file" class="file-input-overwrite" name="image2" id="image2"  data-fouc>
					</div>
					<div style="color:#c1c1c1">Size: 330x140 pixel</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Images 3</label>
					<div class="col-lg-8" id="image_3">
						<input type="file" class="file-input-overwrite" name="image3" id="image3"  data-fouc>
					</div>
					<div style="color:#c1c1c1">Size: 90x60pixel</div>	
				</div>				
				 
				<div class="form-group row" >
					<label class="col-form-label col-lg-2">&nbsp;</label>
					<div class="col-lg-6">
					<button type="button" onclick="save_article()" value="submit" name="submit" class="btn btn-primary" >&nbsp;&nbsp;Submit&nbsp&nbsp; <i style="display: none" class="icon-spinner spinning loading"></i></button>

					</div>
				</div>
			</form>
			</div>
			<div class="col-md-5"><img src="<?php echo base_url()?>assets/preview.jpg" style="max-width:100%"/></div>
			</div>
        </div>
    </div>
    <!-- /basic modals -->

</div>
<!-- /content area -->

 
<script>
	var validator;
	var previewZoomButtonClasses;
	var previewZoomButtonIcons;
	var fileActionSettings;

	jQuery(document).ready(function() {

		$('#image_1').empty();
		$('#image_1').append('<input type="file" class="file-input-overwrite" name="image1" id="image1"  data-fouc>');
	
		$('#image_2').empty();
		$('#image_2').append('<input type="file" class="file-input-overwrite" name="image2" id="image2"  data-fouc>');
	
		$('#image_3').empty();
		$('#image_3').append('<input type="file" class="file-input-overwrite" name="image3" id="image3"  data-fouc>');
	
		_componentFileUpload();

	});



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

		$('#image1').fileinput({
			browseLabel: 'Upload',
			browseIcon: '<i class="icon-file-plus mr-2"></i>',
			uploadIcon: '<i class="icon-file-upload2 mr-2"></i>',
			removeIcon: '<i class="icon-cross2 font-size-base mr-2"></i>',
			layoutTemplates: {
				icon: '<i class="icon-file-check"></i>',
				modal: modalTemplate
			},
		});
		
		 $('#image2').fileinput({
			browseLabel: 'Upload',
			browseIcon: '<i class="icon-file-plus mr-2"></i>',
			uploadIcon: '<i class="icon-file-upload2 mr-2"></i>',
			removeIcon: '<i class="icon-cross2 font-size-base mr-2"></i>',
			layoutTemplates: {
				icon: '<i class="icon-file-check"></i>',
				modal: modalTemplate
			},
		});
		
		$('#image3').fileinput({
			browseLabel: 'Upload',
			browseIcon: '<i class="icon-file-plus mr-2"></i>',
			uploadIcon: '<i class="icon-file-upload2 mr-2"></i>',
			removeIcon: '<i class="icon-cross2 font-size-base mr-2"></i>',
			layoutTemplates: {
				icon: '<i class="icon-file-check"></i>',
				modal: modalTemplate
			},
		});

	};
	
	
	 

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

	function save_article() {
		 
			$('.loading').show();
			
			
			var A = new FormData($('#article_form')[0]); 
			
			var file1 = $("#image1")[0].files[0]; 
			if (file1) {
				A.append("image1", file1);
			}
			var file2 = $("#image2")[0].files[0]; 
			if (file2) {
				A.append("image2", file2);
			}
			var file3 = $("#image3")[0].files[0]; 
			if (file3) {
				A.append("image1", file3);
			}
			 
			var C = new XMLHttpRequest();
			C.open("POST", base_url + 'admin/company/save_article');
			C.onreadystatechange = function () {
				$('.loading').hide();
				if (C.readyState == 4) {
					if (C.status == 200) {
						new PNotify({
							title: 'SUCCESS!',
							text: 'The Operation is correct.',
							icon: 'icon-checkmark3',
							type: 'success'
						});
					}else{
						new PNotify({
							title: 'ERROR!',
							text: 'Canot send request correct.',
							icon: 'icon-checkmark3',
							type: 'error'
						});
					}
				}
			};
			C.onload = function() {
				//location.href = base_url+'admin/company';
				return;
			};
			C.send(A);
		 
	}

</script>
<iframe name="_other" id="_other" hidden></iframe>
