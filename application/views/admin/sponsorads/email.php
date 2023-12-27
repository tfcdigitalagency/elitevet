<style type="text/css">
    .table-bordered>thead {
        background-color: #51a79b;
        color: white;
    }
	.action a{
		cursor:pointer;
	}

	.modal-lg {
		max-width: 80%;
	}
	
	#previewContent{
		width:800px;
		margin:auto;
		position:relative;
	}
	
	#image1_pre{
		width:100%;
		top: 0;
		left: 0;
		z-index:1;
		max-width:100%;
	}
	#image2_pre{
		max-width:300px;
		position:absolute;
		z-index:30;
		top: 0;
		left: 0;
	}
	#sponsor_name{
		position:absolute;
		top: 0;
		left: 0;
		z-index:40;
		font-weight:bold;
		font-size:28px;
	}
	
	#sponsor_description{
		position:absolute;
		top: 0;
		left: 0;
		z-index:50;
	}
	
	.dragable{
		cursor: move;
	}
	
</style>
<!-- Page header -->
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><span class="font-weight-semibold">Newsletter Content</span></h4>
        </div>
    </div>
</div>
<!-- /page header -->

<!-- Content area -->
<div class="content">
	<?php
		$config = $this->db->get_where('tbl_config',array('code'=>'SPONSORAD'))->row();
		
		//print_r($config);
		 
		if($config) {
			$data = json_decode($config->detail);
		}
		
		$logo_style = ($data->logo_style)?$data->logo_style:'width: 200px;';
		$name_style = ($data->name_style)?$data->name_style:'';
		$description_style = ($data->description_style)?$data->description_style:'';
		
		$logo_width = $data->logo_width?$data->logo_width:'200';
		$name_size = $data->name_size?$data->name_size:'20';
		$name_color = $data->name_size?$data->name_color:'#000000';
		$bg_url = $data->image2;
		$logo_url = $data->image;
	?>
    <!-- Basic modals -->
    <div class="card">
        <div class="card-body">
			<div class="row">
            <div class="col-md-5">
                 <form class="form-validate-jquery" method="post" id="sendEmail" action="<?php echo site_url('admin/ads/sendemail')?>">
					 
				<div class="form-group row">
					<label class="col-form-label col-lg-3">Email Subject *</label>
					<div class="col-lg-9">
						<input type="text" class="form-control" value="<?php echo @$data->subject; ?>" name="subject" id="subject" required/>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-3">Background</label>
					<div class="col-lg-9">
						<input type="file" name="image1" id="image1">
						<?php echo str_replace('assets/uploads/sponsorad/','',$bg_url);?>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-3">Logo*</label>
					<div class="col-lg-9">
						<input type="file" name="image2" id="image2" >
						<?php echo str_replace('assets/uploads/sponsorad/','',$logo_url);?>
					</div>
				</div>				
				<div class="form-group row">
					<label class="col-form-label col-lg-3">Title</label>
					<div class="col-lg-9">
						<input type="text" class="form-control" value="<?php echo @$data->content; ?>" name="content" id="content" />						
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-3">Font size</label>
					<div class="col-lg-9">
						<input type="number" class="form-control" value="<?php echo @$name_size; ?>" name="name_size" id="name_size"/>						
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-3">Font color</label>
					<div class="col-lg-9">
						<input type="text" class="form-control" value="<?php echo @$name_color; ?>" name="name_color" id="name_color"/>						
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-3">Content</label>
					<div class="col-lg-9">
						
						<textarea rows="10" class="form-control" name="description" id="description"><?php echo @$data->description?></textarea>						
						<div style="margin-bottom:5px;"><a id="btn_update_content" class="btn btn-success text-white">Add Text to Design</a></div>
					</div>
				</div>
				<div class="form-group row" >
					<label class="col-form-label col-lg-3"> </label>
					<div class="col-lg-4">
						
						<button type="button" value="save" name="save" id="save_content" class="btn btn-warning" >Save</button>						 
						<i id="loadding" style="display:none" class="icon-spinner spinning hide loading"></i>
					</div>
					<div class="col-lg-5">
					<button type="submit" value="submit" name="submit" class="btn btn-danger" >Add to QUEUE</button> &nbsp;
					<button type="button" id="btn_modal_test" class="btn btn-primary" >Test Email</button></div>
					<div class="col-lg-3"></div>
					<div class="col-lg-9" style="color:red;padding-top:20px;">* Notice: You must click button "Save" if you have any change in design.</div>
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
			<div class="col-md-7" style="border:1px solid #e1e1e1;">
				<div style="text-align:center; color:red;">You can drag and drop logo & text for change position.</div>
				<div id="domImg" style="display:inline-block;">
				<div id="previewContent">
					<img style="width:100%;" id="image1_pre" src="<?php echo base_url().$bg_url;?>"/>
					<img id="image2_pre" src="<?php echo base_url().$logo_url;?>" style="<?php echo $logo_style?>" class="dragable"/>
					<h2 id="sponsor_name" style="<?php echo $name_style?>" class="dragable"><?php echo @$data->content; ?></h2>	
					<div id="sponsor_description" style="<?php echo $description_style;?>" class="dragable"><?php echo @$data->description;?></div>
				</div>
				</div>
				<canvas id="canvas" style="display:none"></canvas>
			</div>
			</div>
    <!-- /basic modals -->
 
</div>

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
				<div id="contentEmailPreview">
				
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div id="modalTestEmail" class="modal" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Send Test Email</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Email*</label>
					<div class="col-lg-8">
						<input type="email" class="form-control" value="" name="testmail" id="testmail" required="">
						
					</div>
					<div class="col-lg-2"><button type="button" class="btn btn-primary" id="btn_send_test">SEND</button></div>
				</div>
				</form>
			</div> 
		</div>
	</div>
</div>
</div>
</div>
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script src = "<?php echo base_url();?>assets/dom-to-image.min.js"></script>

<!-- /content area -->
<script src="https://cdn.tiny.cloud/1/f3u1hs5fn8m7a9cqwdfsmvcpopd0vtithscdlflgcn34mv6q/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
	$( document ).ready(function() {
		tinymce.init({
			selector: '#description',
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
	$( ".dragable" ).draggable();
	$( "#previewContent" ).droppable();
	
	$('#logo_width').keyup(function(){
		$('#image2_pre').width(parseInt($(this).val()));
	});
	$('#content').keyup(function(){
		$('#sponsor_name').text($(this).val());
	});
	$('#name_size').keyup(function(){
		$('#sponsor_name').css("fontSize",parseInt($(this).val()));
	});
	$('#name_color').keyup(function(){
		$('#sponsor_name').css("color",$(this).val());
	});
	$('#content').change(function(){
		$('#sponsor_name').text($(this).val());
	});
	$('#name_size').change(function(){
		$('#sponsor_name').css("fontSize",parseInt($(this).val()));
	});
	$('#name_color').change(function(){
		$('#sponsor_name').css("color",$(this).val());
	});
		
	function uploadCanvas(dataURL) {
    var blobBin = atob(dataURL.split(',')[1]);
    var array = [];
    for(var i = 0; i < blobBin.length; i++) {
        array.push(blobBin.charCodeAt(i));
    }
    var file=new Blob([new Uint8Array(array)], {type: 'image/png'});
    var formdata = new FormData();
    formdata.append("image", file);
    
    $.ajax({
       url: "save.php",
       type: "POST",
       data: formdata,
       processData: false, // important
       contentType: false  // important
    }).complete(function(response){
      console.log(response.status);
    });
  }
  var image1,image2, canvas, context, image1_pre,image2_pre;

  image1 = document.getElementById("image1");
  image2 = document.getElementById("image2");
  canvas = document.getElementById("canvas");
  context = canvas.getContext('2d');
  image1_pre = document.getElementById("image1_pre");
  image2_pre = document.getElementById("image2_pre");

  image1.addEventListener("change", function() {
    var reader = new FileReader();

    reader.addEventListener("loadend", function(arg) {
      var src_image = new Image();

      src_image.onload = function() {
        canvas.height = src_image.height;
        canvas.width = src_image.width;
        context.drawImage(src_image, 0, 0);
        var imageData = canvas.toDataURL("image/png"); 
        image1_pre.src = imageData;
        //uploadCanvas(imageData);
      }

      src_image.src = this.result;
    });

    reader.readAsDataURL(this.files[0]);
  });
  image2.addEventListener("change", function() {
    var reader = new FileReader();
	 
    reader.addEventListener("loadend", function(arg) {
      var src_image = new Image();

      src_image.onload = function() {
        canvas.height = src_image.height;
        canvas.width = src_image.width;
        context.drawImage(src_image, 0, 0);
        var imageData = canvas.toDataURL("image/png"); 
        image2_pre.src = imageData;
        //uploadCanvas(imageData);
      }

      src_image.src = this.result;
    });
	
    reader.readAsDataURL(this.files[0]);
  });
	 
	
	function validateEmail(email) {
	  var re = /\S+@\S+\.\S+/;
	  return re.test(email);
	}
 
	$('#btn_update_content').click(function(){
		var text = tinyMCE.get('description').getContent();
		$('#sponsor_description').html(text);
		
	});
	
	$('#btn_modal_test').click(function(){
		$('#modalTestEmail').modal('show');
	})
	
	$('#btn_send_test').click(function(){
		var email = $('#testmail').val();
		
		if(!email || !validateEmail(email)){
			$('#testmail').focus();
		}else{
			$('#loadding').show();
			jQuery.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>" + "admin/sponsorad/sendtest",
					data :'email='+email,
					dataType: 'json',					 
					success: function (res) {
						$('#modalTestEmail').modal('hide');
						sending = false;
						$('#loadding').hide();
						$('#survey_msg').html(res.message).show();
						new PNotify({
							title: 'SUCCESS!',
							text: 'Test email has been sent!',
							icon: 'icon-checkmark3',
							type: 'success'
						});
					},
					error:function() {
						sending = false;
						$('#modalTestEmail').modal('hide');
						$('#loadding').hide();
						$('#survey_msg').html('Error! try again.').show();
					  }
			});
		}
	});
	
	$('#type').change(function (){
		var val = $(this).val();
		if(val){
			$('#individual_wrap').show();
		}else{
			$('#individual_wrap').hide();
		}
	})
 
	var sending = false;
	$('#sendEmail').submit(function(e){
		
		if(!confirm('Do you want to send this email to all users?')) return false;
		
		e.preventDefault();
		if(sending){
			return false;
		}
		sending = true;
		$('#loadding').show();
		$('#survey_msg').html('<i class="icon-spinner spinning hide loading"></i>Sending...').show(); 
		jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "admin/sponsorad/sendemail",
				data :"",
                dataType: 'json',
				async: true,
				cache: false,
				contentType: false,
				processData: false,
				timeout: 60000,
                success: function (res) {
					sending = false;
					$('#loadding').hide();
					$('#survey_msg').html(res.message).show();
					new PNotify({
							title: 'SUCCESS!',
							text: 'Emails have been sent!',
							icon: 'icon-checkmark3',
							type: 'success'
						});
				},
				error:function() {
					sending = false;
					$('#loadding').hide();
					$('#survey_msg').html('Error! try again.').show();
				  }
		});


	});

	$('#save_content').click(function (){

		var val = $('#subject').val();
		if(!val){
			$('#subject').focus();
			return;
		}
		var val = $('#content').val();
		if(!val){
			$('#content').focus();
			return;
		}
		
		
		
		var image = $("#image2")[0].files[0]; //logo
        var image2 = $("#image1")[0].files[0];//bg
		
		var logo_style = $('#image2_pre').attr("style");
		var name_style = $('#sponsor_name').attr("style");	
		var description_style = $('#sponsor_description').attr("style");	
		
		var A = new FormData();
		A.append("subject", $("#subject").val());
		A.append("content", $("#content").val());
		A.append("description", tinyMCE.get('description').getContent());
		A.append("name_size", $("#name_size").val());
		A.append("name_color", $("#name_color").val());
		A.append("logo_style", logo_style);
		A.append("name_style", name_style);
		A.append("description_style", description_style);
		if (image) {
			A.append("image", image);
		}
		if (image2) {
			A.append("image2", image2);
		}
		var node = document.getElementById('domImg');
		domtoimage.toPng(node).
		then(function (dataUrl) {
			 
			var blobBin = atob(dataUrl.split(',')[1]);
			var array = [];
			for(var i = 0; i < blobBin.length; i++) {
				array.push(blobBin.charCodeAt(i));
			}
			var file=new Blob([new Uint8Array(array)], {type: 'image/png'});		
			A.append("file", file);
				
			$('#loadding').show();
			$('#save_content').text('Saving...');
			jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "admin/sponsorad/save",
				data :A,
                dataType: 'json',
				async: true,
				cache: false,
				contentType: false,
				processData: false,
				timeout: 60000,
                success: function (res) {
					sending = false;
					$('#loadding').hide();
					$('#survey_msg').html(res.message).show();
					$('#save_content').text('Save');
					new PNotify({
							title: 'SUCCESS!',
							text: 'Content has been saved.',
							icon: 'icon-checkmark3',
							type: 'success'
						});
				},
				error:function() {
					sending = false;
					$('#loadding').hide();
					$('#survey_msg').html('Error! try again.').show();
					$('#save_content').text('Save');
					new PNotify({
							title: 'Error!',
							text: 'Error! try again.',
							icon: 'icon-checkmark3',
							type: 'error'
						});
				  }
			});
		});
		 
	});

	 
	function backList() {
        location.href = base_url+'admin/admin/sponsorad';
     }

	function checkURLImage(url) {
		return(url.match(/\.(jpeg|jpg|gif|png)$/) != null);
	}

</script>
