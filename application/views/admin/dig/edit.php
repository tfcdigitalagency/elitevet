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

			<form class="form-validate-jquery" id="article_form" method="post" action="<?php echo site_url('admin/dig/edit')?>">
				<input type="text" class="form-control" id="article_id" name="article_id" value="<?php echo $data['id']; ?>" hidden>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Title *</label>
					<div class="col-lg-10">
						<input class="form-control" id="title" name="title" placeholder="Please Input Title" value="<?php echo $data['title']; ?>" required/>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Images</label>
					<div class="col-lg-6" id="image_">
						<input type="file" class="file-input-overwrite" name="image" id="image"  data-fouc>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Type</label>
					<div class="col-lg-6" id="pdf_type_wrap">
						<label><input type="radio" name="type" value="1" <?php echo $data['type']?'checked':''; ?> id="type1"> Pdf File <label>
						<label style="margin-left:15px;"><input type="radio" name="type" value= "0" <?php echo $data['type']?'':'checked'; ?> id="type0"> Pdf URL <label>
					</div>
				</div>
				
				
				<div id="pdf_wrap" style="display:<?php echo $data['type']?'flex':'none'; ?>" class="form-group row">
					<label class="col-form-label col-lg-2">Pdf</label>
					<div class="col-lg-6" id="pdf_">
						<input type="file" class="file-input-overwrite" name="pdf_file" id="pdf_file"  data-fouc>
					</div>
				</div>  
				<div id="url_wrap" style="display:<?php echo $data['type']?'none':'flex'; ?>"  class="form-group row">
					<label class="col-form-label col-lg-2">Pdf url view</label>
					<div class="col-lg-6" id="pdf_view">
						<input class="form-control" id="pdf_view" name="pdf_view" value="<?php echo $data['pdf_view']; ?>" placeholder="Please Input Pdf Link"/>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Display in Homepage</label>
					<div class="col-lg-6" >
					<?php $status = intval($data['home']);?>
						<label><input type="checkbox" name="home" value="1" <?php echo $status?'checked':''; ?> > Homepage <label>
						
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Display position</label>
					<div class="col-lg-6">
					<?php
					$aryPosition = array(1=>'Position 1',2=>'Position 2',3=>'Position 3',4=>'Position 4')
					?>
						<label>
							<select name="position" class="form-control">
							<option value="">--Not set--</option>
							<?php foreach($aryPosition as $k=>$v){
								?>
								<option value="<?php echo $k?>" <?php if($data['position'] == $k) echo 'selected'?>><?php echo $v?></option>
								<?php
							}?>
							</select>
						<label>
						
					</div>
				</div>
				<div class="form-group row" >
					<label class="col-form-label col-lg-2">&nbsp;</label>
					<div class="col-lg-6">
						<button type="button" onclick="save_article()" class="btn btn-primary" >&nbsp;&nbsp;Submit&nbsp&nbsp; <i style="display: none" class="icon-spinner spinning loading"></i></button>
						<button type="button" onclick="send_dm()" class="btn btn-primary" >&nbsp;&nbsp;Send DM to Customer&nbsp&nbsp; <i style="display: none" class="icon-spinner spinning loading_dm"></i></button>
						<div id="survey_msg" style="margin-top:20px;"></div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- /basic modals -->

</div>
<!-- /content area -->

 

<script>
	var base_url = '<?= base_url() ?>';
	var validator;
	var icon='<?php echo $data['photo']; ?>';
	var pdf='<?php echo $data['pdf']; ?>';
	var modalTemplate;
	var previewZoomButtonClasses;
	var previewZoomButtonIcons;
	var fileActionSettings;
	
	$('#pdf_type_wrap input').click(function(){
		var val = parseInt($(this).val());
		if(val){
			$('#pdf_wrap').show();
			$('#url_wrap').hide();
		}else{
			$('#pdf_wrap').hide();
			$('#url_wrap').show();
		}
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

	};

	jQuery(document).ready(function() {

		if(icon==''){
			/*$('#image_').empty();
			$('#image_').append('<input type="file" class="file-input-overwrite" name="image" id="image"  data-fouc>');
			_componentFileUpload();*/
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
		
		if(pdf==''){
			/*$('#pdf_').empty();
			$('#pdf_').append('<input type="file" class="file-input-overwrite" name="pdf_file" id="pdf_file"  data-fouc>');
			_componentFileUpload();*/
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

		}else{
			 
			$('#pdf_').empty();
			$('#pdf_').append('<input type="file" class="file-input-overwrite" name="pdf_file" id="pdf_file"  data-fouc>');

			var icon_path = base_url + pdf;


			$('#pdf_file').fileinput({
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
			$('#pdf_ .kv-file-content').html(html);
		}

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
						location.href = base_url+'admin/dig';
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
	
	function send_dm() {
			if(!confirm('Do you want to send email to customer?')) return;
			$('.loading_dm').show(); 
			jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "admin/dig/sendemail",
				data : { 
					article_id: $('#article_id').val()
				},
                dataType: 'json',
                success: function (res) {
					sending = false;
					$('.loading_dm').hide();
					$('#survey_msg').html(res.message).show();
				},
				error:function() {
					sending = false;
					$('.loading_dm').hide();
					$('#survey_msg').html('Error! try again.').show();
				  }
		});
		 
	}

</script>
<iframe name="_other" id="_other" hidden></iframe>
