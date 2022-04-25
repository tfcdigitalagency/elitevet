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

                <div class="form-group row" hidden>
                    <label class="col-form-label col-lg-2">Contact Email:</label>
                    <div class="col-lg-10">
                        <select multiple="multiple" class="form-control" id="address">
                        <?php for($k=0;$k<count($contact);$k++){ ?>
                            <option value="<?php echo $contact[$k]['email']; ?>" selected><?php echo $contact[$k]['email']; ?></option>
                        <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row" style="float: right;">
                    <button type="button" class="btn btn-success" onclick="save_mailchimp()" style="margin-right: 10px;">&nbsp&nbsp Save &nbsp&nbsp <i class="icon-spinner spinning hide loading"></i></button>
                    <button type="button" class="btn btn-primary" onclick="send_Email()">Send</button>
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
            cache: false,
            success: function(result) {
                new PNotify({
                    title: 'Success!',
                    text: 'Send Email Success.',
                    icon: 'icon-checkmark3',
                    type: 'success'
                });
                //$('#content').val("");
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

