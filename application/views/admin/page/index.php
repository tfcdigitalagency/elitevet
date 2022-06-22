<style type="text/css">
    .table-bordered>thead {
        background-color: #51a79b;
        color: white;
    }
	.action a{
		cursor:pointer;
	}
</style>
<!-- Page header -->


<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><span class="font-weight-semibold">Page <?php echo @$page_code; ?></span></h4>
        </div>
    </div>
</div>
<!-- /page header -->

<!-- Content area -->
<div class="content">

    <!-- Basic modals -->
    <div class="card">
        <div class="card-body">

            <div class="col-md-12">
                 <form class="form-validate-jquery" method="post" id="sendEmail" action="<?php echo site_url('admin/ads/sendemail')?>">

				<div class="form-group row">
					<label class="col-form-label col-lg-2">Page title *</label>
					<div class="col-lg-10">
						<input type="text" class="form-control" value="<?php echo @$page_content->title; ?>" name="title" id="title" required/>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Page content *</label>
					<div class="col-lg-10">
						<textarea rows="5" cols="3" class="form-control" id="content" name="content" placeholder="Please Enter content" required><?php echo @$page_content->content; ?></textarea>
					</div>
				</div>
				<div class="form-group row" >
					<label class="col-form-label col-lg-2"> </label>
					<div class="col-lg-10">
<!--					<button type="submit" value="submit" name="submit" class="btn btn-primary" >&nbsp;&nbsp;Submit</button> &nbsp;-->
					<button type="button" value="save" name="save" id="save_content" class="btn btn-warning" >Save</button>
						<i id="loadding" style="display:none" class="icon-spinner spinning hide loading"></i>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2"> </label>
					<div class="col-lg-10">
						<div id="survey_msg"><div>
					</div>
				</div>

			</form>
            </div>
        </div>
    </div>
    <!-- /basic modals -->

</div>
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

	$('#save_content').click(function (){

		var val = $('#title').val();
		if(!val){
			$('#title').focus();
			return;
		}
		var val = tinyMCE.get('content').getContent().replaceAll('<img src="../assets/', '<img src="http://ncdeliteveterans.org/assets/');
		if(!val){
			$('#content').focus();
			return;
		}
		$('#loadding').show();
		jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>" + "admin/page/save?page=<?=$page_code?>",
			data : {
				title: $('#title').val(),
				content: tinyMCE.get('content').getContent().replaceAll('<img src="../assets/', '<img src="http://ncdeliteveterans.org/assets/')
			},
			dataType: 'json',
			success: function (res) {
				$('#loadding').hide();
				$('#survey_msg').html(res.message).show();
			},
			error:function() {
				$('#loadding').hide();
				$('#survey_msg').html('Error! try again.').show();
			}
		});
	});

</script>
