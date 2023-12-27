<!-- Page header -->
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><span class="font-weight-semibold">Import</span></h4>
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

        	<form class="form-validate-jquery" id="article_form" method="post"  enctype="multipart/form-data" action="<?php echo site_url('admin/grant/doimport')?>">
        		 <div class="form-group mb-3">
					<div class="mb-3">
						<div> Please upload csv file.</div>
						<input type="file" name="csv_file" class="form-control" id="csv_file">
					</div>					   
				</div>
				<div class="d-grid mb-3">
					<input type="submit" name="submit" value="Upload" class="btn btn-primary" /> &nbsp;&nbsp;
					<a href="<?php echo site_url('admin/grant/')?>" class="btn btn-dark">Back</a>
				</div>
			</form>
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

		$('#image_').empty();
		$('#image_').append('<input type="file" class="file-input-overwrite" name="image" id="image"  data-fouc>');
		
		$('#pdf_').empty();
		$('#pdf_').append('<input type="file" class="file-input-overwrite" name="pdf_file" id="pdf_file"  data-fouc>');
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
		
		$('#pdf_file').fileinput({
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
			
			var file = $("#image")[0].files[0];
			var file2 = $("#pdf_file")[0].files[0];
			var A = new FormData($('#article_form')[0]);
 
			if (file) {
				A.append("icon", file);
			}
			if (file2) {
				A.append("pdf", file2);
			}
			var C = new XMLHttpRequest();
			C.open("POST", base_url + 'admin/dig/save_article');
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
				location.href = base_url+'admin/dig';
				return;
			};
			C.send(A);
		 
	}

</script>
<iframe name="_other" id="_other" hidden></iframe>
