<!-- Page header -->
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
						<label><input size="100" type="email" class="form-control" value="" name="test_email" id="test_email"/></label>
					</div>
				</div>

                <div class="form-group row" >
					<label class="col-form-label col-lg-1"> </label>
					<div class="col-lg-11">
                    <button type="button" class="btn btn-success" onclick="save_mailchimp()" style="margin-right: 10px;">&nbsp&nbsp Save &nbsp&nbsp <i class="icon-spinner spinning hide loading"></i></button>
                    <button type="button" class="btn btn-primary" onclick="send_Email()">Send</button>
                    <button type="button" class="btn btn-warning" onclick="send_test()()">Send Test Email</button>
					<div id="message"></div>
					</div>
                </div>


            </form>
        </div>
    </div>
    <!-- /basic modals -->

</div>
<!-- /content area -->

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

        $.ajax({
            url: base_url+'admin/webinar/send_Email',
            type : 'POST',
            data : {
                description: tinyMCE.get('content').getContent().replaceAll('<img src="../../assets/', '<img src="http://ncdeliteveterans.org/assets/'),
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

	function send_test() {
		if(!$('#test_email').val()){
			$('#test_email').focus();
			return;
		}
        $.ajax({
            url: base_url+'admin/webinar/send_test',
            type : 'POST',
            data : {
                description: tinyMCE.get('content').getContent().replaceAll('<img src="../../assets/', '<img src="http://ncdeliteveterans.org/assets/'),
                address: $('#address').val(),
                subject: $('#subject').val(),
				disable_ads: $('#disable_ads').is(":checked")?1:0,
				test_email: $('#test_email').val()
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

    function save_mailchimp(){
        if(loading == false){
            loading = true;
            $('.loading').removeClass('hide');
            $.ajax({
                url: base_url+'admin/webinar/save_mailchimp',
                type : 'POST',
                data : {
                  content: tinyMCE.get('content').getContent().replaceAll('<img src="../../assets/', '<img src="http://ncdeliteveterans.org/assets/')
                },
                cache: false,
                success: function(result) {
                  new PNotify({
                      title: 'Success!',
                      text: 'SaveMailchimp Success.',
                      icon: 'icon-checkmark3',
                      type: 'success'
                  });
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

