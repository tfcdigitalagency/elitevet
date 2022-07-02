<!-- Page header -->
<div class="page-header page-header-light">
	<div class="page-header-content header-elements-md-inline">
		<div class="page-title d-flex">
			<h4><span class="font-weight-semibold">Update Article</span></h4>
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

			<form class="form-validate-jquery" id="article_form" method="post" action="<?php echo site_url('admin/news/edit')?>">
				<input type="text" class="form-control" id="article_id" name="article_id" value="<?php echo $data['id']; ?>" hidden>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Title *</label>
					<div class="col-lg-10">
						<input class="form-control" id="title" name="title" placeholder="Please Input Title" value="<?php echo $data['article_title']; ?>" required/>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Images</label>
					<div class="col-lg-6" id="image_">
						<input type="file" class="file-input-overwrite" name="image" id="image"  data-fouc>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Short Desciption *</label>
					<div class="col-lg-10">
						<textarea rows="5" cols="3" class="form-control" id="short" name="short" required><?php echo $data['short']; ?></textarea>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Detail *</label>
					<div class="col-lg-10">
						<textarea rows="5" cols="3" class="form-control" id="content" name="content"><?php echo $data['detail']; ?></textarea>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-lg-2">Status</label>
					<div class="col-lg-2">
						<select class="form-control" id="status"  name="status">
							<option value="">Draft</option>
							<option value="1" <?php echo $data['status']?'selected':''; ?>>Published</option>
						</select>
					</div>
				</div>

				<div class="form-group row" >
					<label class="col-form-label col-lg-2">&nbsp;</label>
					<div class="col-lg-6">
						<button type="button" onclick="save_article()" value="submit" name="submit" class="btn btn-primary" >&nbsp;&nbsp;Submit&nbsp&nbsp; <i style="display: none" class="icon-spinner spinning hide loading"></i></button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- /basic modals -->

</div>
<!-- /content area -->


<!-- /content area -->
<script src="https://cdn.tiny.cloud/1/f3u1hs5fn8m7a9cqwdfsmvcpopd0vtithscdlflgcn34mv6q/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
	$( document ).ready(function() {
		tinymce.init({
			selector: '#content',
			content_css: '//www.tiny.cloud/css/codepen.min.css',
			plugins: 'link image code',
			//toolbar: 'undo redo | link image | code',
			toolbar: ['undo redo copy cut paste redo remove removeformat selectall | styleselect fontselect fontsizeselect lineheight | forecolor formatselect',' h1 h2 h3 h4 h5 h6 | bold italic strikethrough | alignleft aligncenter alignright alignjustify alignnone | blockquote backcolor | outdent indent | link image | code'],
			height: "600",
			/* enable title field in the Image dialog*/
			image_title: true,
			/* enable automatic uploads of images represented by blob or data URIs*/
			automatic_uploads: true,
			remove_linebreaks: false,
			file_picker_types: 'image',
			images_upload_url: '<?=base_url()?>admin/Webinar/uploadImage'
		});
	});
</script>


<script>
	var base_url = '<?= base_url() ?>';
	var validator;
	var icon='<?php echo $data['photo']; ?>';
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

	};

	jQuery(document).ready(function() {

		if(icon==''){
			$('#image_').empty();
			$('#image_').append('<input type="file" class="file-input-overwrite" name="image" id="image"  data-fouc>');
			_componentFileUpload();

		}else{
			$('#image_').empty();
			$('#image_').append('<input type="file" class="file-input-overwrite" name="image" id="image"  data-fouc>');

			var icon_path = base_url + icon;


			$('#image').fileinput({
				browseLabel: 'Search',
				browseIcon: '<i class="icon-file-plus mr-2"></i>',
				uploadIcon: '<i class="icon-file-upload2 mr-2"></i>',
				removeIcon: '<i class="icon-cross2 font-size-base mr-2"></i>',
				layoutTemplates: {
					icon: '<i class="icon-file-check"></i>',
					modal: modalTemplate
				},
				initialPreview: [
					icon_path
				],
				initialPreviewConfig: [
					{caption: 'Icon', size: 930321, key: 1, url: icon_path, showDrag: false},
				],
				initialPreviewAsData: true,
				overwriteInitial: true,
				previewZoomButtonClasses: previewZoomButtonClasses,
				previewZoomButtonIcons: previewZoomButtonIcons,
				fileActionSettings: fileActionSettings
			});

			var html = '<img src="' + icon_path + '" style="width:auto;height:auto;max-width:100%;max-height:100%;" class="file-preview-image kv-preview-data">';
			$('.kv-file-content').html(html);
		}

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
		var content =  tinyMCE.get('content').getContent().replaceAll('<img src="../assets/', '<img src="http://ncdeliteveterans.org/assets/');
		var check = validator.checkForm();
		if(!content) return;
		if (!check)
			validator.showErrors();
		else{

			var file = $("#image")[0].files[0];
			var A = new FormData($('#article_form')[0]);

			A.append("detail",content);

			if (file) {
				A.append("icon", file);
			}
			var C = new XMLHttpRequest();
			C.open("POST", base_url + 'admin/news/save_article');
			C.onreadystatechange = function () {
				if (xhr.readyState == 4) {
					if (xhr.status == 200) {
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
			C.send(A);
		}
	}

</script>
<iframe name="_other" id="_other" hidden></iframe>
