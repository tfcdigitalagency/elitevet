<!-- Page header -->
<style>
	.modal-lg {
		max-width: 80%;
	}
</style>
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><span class="font-weight-semibold">Edit Email</span></h4>
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
                <input type="text" class="form-control" id="owner_id"  value="<?php echo $owner_id; ?>" hidden>
			<div class="form-group row">
			  <label class="col-form-label col-lg-1">Subject:</label>
			  <div class="col-lg-11">
				<input type="text" class="form-control" id="subject" name="subject" value="<?=$subject?>" />
			  </div>
			</div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-1">Email:</label>
                    <div class="col-lg-11">
                        <textarea rows="5" cols="3" class="form-control" id="content" ><?=$mailchimp?></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label col-lg-1">Ads Options:</label>
                    <div class="col-lg-11">
                        <label><input type="checkbox" value="1" name="disable_ads" id="disable_ads"> Do not include Ads content.</label>
                    </div>

				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-1">Overwrite Test Email:</label>
					<div class="col-lg-11">
						<label style="display:flex; ">
						<div><input size="50" type="email" class="form-control" value="" name="test_email" id="test_email"/></div>
						<div style="width:100px;padding:10px;">Send Type:</div>
						<div><select style="width:200px;" class="form-control" id="send_type" name="send_type">
						<option value='smtp'>SMTP</option><option value='mail'>PHP mail()</option>
						</select>
						</div>
						</label>
					</div>
				</div>

                <div class="form-group row" >
					<label class="col-form-label col-lg-1"> </label>
					<div class="col-lg-11">
                    <button type="button" class="btn btn-success" onclick="save_mailchimp()" style="margin-right: 10px;">&nbsp&nbsp Save &nbsp&nbsp <i class="icon-spinner spinning hide loading"></i></button>
                    <button type="button" class="btn btn-primary" onclick="send_Email()" style="margin-right: 10px;">Send</button>
                    <button type="button" class="btn btn-warning" onclick="send_test()">Send Test Email</button>
					<button type="button" class="btn btn-default" onclick="preview_email()"><i class="icon-eye"></i>Perview Email</button>
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

<style>
.spinning{
  animation: fa-spin 2s linear infinite;
}
@-webkit-keyframes fa-spin {
 0% {
  -webkit-transform:rotate(0deg);
  transform:rotate(0deg)
 }
 to {
  -webkit-transform:rotate(1turn);
  transform:rotate(1turn)
 }
}
.hide{
  display:  none;
}
</style>

<script>

    var base_url = '<?= base_url() ?>';
    var loading = false;
    function send_Email() {
		if(!confirm('Do you want to send email to user now?')) return;
		var t = new Date().getTime();
        $.ajax({
            url: base_url+'admin/webinar/send_Email?t='+t,
            type : 'POST',
            data : {
                description: tinyMCE.get('content').getContent().replaceAll('../../', 'https://ncdeliteveterans.org/'),
                address: $('#address').val(),
                subject: $('#subject').val()
            },
			dataType: 'json',
            cache: false,
            success: function(result) {
                new PNotify({
                    title: 'Success!',
                    text: 'Send Email Success.',
                    icon: 'icon-checkmark3',
                    type: 'success'
                });
                $('#message').html(result.message);
            }
        });
    }

	function preview_email(){
		var t = new Date().getTime();
		$.ajax({
			url: base_url+'admin/webinar/save_preview?t='+t,
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

	function send_test() {
		if(!$('#test_email').val()){
			$('#test_email').focus();
			return;
		}
		var t = new Date().getTime();
        $.ajax({
            url: base_url+'admin/webinar/send_test?t='+t,
            type : 'POST',
            data : {
                description: tinyMCE.get('content').getContent().replaceAll('../../', 'https://ncdeliteveterans.org/'),
                address: $('#address').val(),
                subject: $('#subject').val(),
				disable_ads: $('#disable_ads').is(":checked")?1:0,
				test_email: $('#test_email').val(),
				send_type: $('#send_type').val()
            },
			dataType: 'json',
            cache: false,
            success: function(result) {
						if(result.status){
							new PNotify({
								title: 'Success!',
								text: 'Send Email Success.',
								icon: 'icon-checkmark3',
								type: 'success'
							});
						}else{
							new PNotify({
								title: 'Error!',
								text: 'Cannot send email',
								icon: 'icon-checkmark3',
								type: 'error'
							});
						}
                
                $('#message').html(result.message);
            }
        });
    }

    function save_mailchimp(){
        if(loading == false){
            loading = true;
            $('.loading').removeClass('hide');
			var t = new Date().getTime();
            $.ajax({
                url: base_url+'admin/webinar/save_mailchimp?t='+t,
                type : 'POST',
                data : {
                  content: tinyMCE.get('content').getContent().replaceAll('../../', 'https://ncdeliteveterans.org/')
                },
                cache: false,
				dataType: 'json',
                success: function(result) {
				  if(result.status){	
					  new PNotify({
						  title: 'Success!',
						  text: 'SaveMailchimp Success.',
						  icon: 'icon-checkmark3',
						  type: 'success'
					  });
					}else{
						alert("System error, server is not allow now");
					}
                },
				error: function (xhr, ajaxOptions, thrownError) {
					alert(xhr.status);
					alert(thrownError);
				},
                complete: function(){
                  loading = false;
                  $('.loading').addClass('hide');
                }
            });
          }
    }

</script>
<iframe name="_other" id="_other" hidden></iframe>


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

