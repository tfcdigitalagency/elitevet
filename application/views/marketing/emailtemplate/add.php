<!-- Page header -->
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><span class="font-weight-semibold">Add Template</span></h4>
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

        	<form class="form-validate-jquery" id="article_form" method="post" action="<?php echo site_url('marketing/EmailTemplate/add')?>">
        		<input type="text" class="form-control" id="article_id" name="article_id" value="" hidden>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Template Name *</label>
					<div class="col-lg-10">
						<input class="form-control" id="template_name" name="template_name" placeholder="Please Input Template Name" required/>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Email Subject</label>
					<div class="col-lg-10">
						<input type="text" class="form-control" rows="3" id="subject" name="subject" placeholder="Email subject"/>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-lg-2">Email Content</label>
					<div class="col-lg-10">
						<textarea rows="5" cols="3" class="form-control" id="content" ><?=$mailchimp?></textarea>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-lg-2">Status</label>
					<div class="col-lg-10">
						<select class="form-control" id="status" name="status">
							<option value="1">Active</option>
							<option value="0">Disable</option>
						</select>
					</div>
				</div>

				<div class="form-group row" >
					<label class="col-form-label col-lg-2">&nbsp;</label>
					<div class="col-lg-6">
						<button type="button" class="btn btn-primary" onclick="save_article()" style="margin-right: 10px;">&nbsp&nbsp Add &nbsp&nbsp <i style="display: none" class="icon-spinner spinning hide loading"></i></button>
						<button type="button" class="btn btn-default" onclick="preview_email()"><i class="icon-eye"></i>Perview Email</button>

						<a style="margin-left: 20px;" class="btn btn-default" href="<?php echo site_url('marketing/emailtemplate')?>">Back</a>
						<div id="message"></div>
					</div>
				</div>
			</form>
        </div>
    </div>
    <!-- /basic modals -->

</div>
<!-- /content area -->
<div id="modalPreview" class="modal" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Email Content Preview</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div id="contentEmailPreview"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
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

	function preview_email(){
		var t = new Date().getTime();
		$.ajax({
			url: base_url+'marketing/EmailTemplate/preview?t='+t,
			type : 'POST',
			data : {
				content: tinyMCE.get('content').getContent().replaceAll('../../', 'https://ncdeliteveterans.org/')
			},
			dataType: 'json',
			cache: false,
			success: function(result) {
				if(result.preview){
					$('#contentEmailPreview').html(result.preview);
					$('#modalPreview').modal('show');
				}else{
					alert("System error, server is not allow now");
				}
			}
		});
	}

	function save_article() {
		 	$('.input_error').removeClass('input_error');
			$('.loading').show();
			if(!$('#template_name').val()){
				$('#template_name').addClass('input_error');
				return
			}
			$.ajax({
				url: base_url + 'marketing/EmailTemplate/save_article',
				type : 'POST',
				data : {
					template_name: $('#template_name').val(),
					subject: $('#subject').val(),
					status: $('#status').val(),
					content: tinyMCE.get('content').getContent().replaceAll('../../', 'https://ncdeliteveterans.org/')
				},
				cache: false,
				success: function(result) {
					swal({
						title:'Success!',
						text:'Your operation successfully!',
						type:'success',
						confirmButtonClass: 'btn btn-primary',
						confirmButtonText: 'Confirm',
					});

					$('.loading').hide();

					setTimeout(function(){
						document.location = base_url + 'marketing/EmailTemplate'
					}, 5000);
				},
				error: function(){
					new PNotify({
						title: 'ERROR!',
						text: 'Cannot send request correct.',
						icon: 'icon-checkmark3',
						type: 'error'
					});
					$('.loading').hide();
				}
			});

		 
	}

</script>
