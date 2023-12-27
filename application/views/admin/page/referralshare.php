<style type="text/css">
    .table-bordered>thead {
        background-color: #51a79b;
        color: white;
    }
	.action a{
		cursor:pointer;
	}
</style>
<style>


.wrapper{
  width:  1500px;
  margin:  auto;
  max-width: 100%;
}

label{
	cursor:pointer;
	margin-right:15px;
}

.memberBoard .memberCell{
	border:1px solid #f1f1f1;
	border-left:7px solid #f2795a;
	margin:20px;
	padding:20px; 
}

 .memberCell .name{
	 font-size: 1.5rem;
    text-transform: none;
    font-weight: 400;
    font-family: Oswald, sans-serif;
    margin: 0;
	color:#f2795a !important;
 }
 .memberCell .position{
	font-size: 1.125rem;
    letter-spacing: 0px;
    font-weight: 600;
    text-transform: none;
    margin: 10px 0 0;
	color: #b3b3b3 !important;
 }
 .memberCell .contact{
 
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
			<h3>Social share media contents</h3>
                 <form class="form-validate-jquery" method="post" id="frm_statistic" action="<?php echo site_url('admin/ads/sendemail')?>">

				<div class="form-group row">
					<label class="col-form-label col-lg-2">Title *</label>
					<div class="col-lg-10">
						<input type="text" class="form-control" value="<?php echo @$page_content->title; ?>" name="title" id="title" required/>
					</div>
					<div class="col-lg-10">
					<label class="col-form-label col-lg-3">Description</label>
						<textarea type="text" class="form-control" rows="5" style="width:100%" name="description" id="description" required><?php echo @$page_content->description; ?></textarea>
					</div>
					<div class="col-lg-10">
							<label class="col-form-label col-lg-3">Upload Image (images must have a width greater than or equal to 1200 pixels)</label>
							 
								<input type="file" name="image1" id="image1">								 
								<div style="display:<?=$page_content->image1?'':'none'?>"><img id="image1_pre" style="width:150px; height:150px;" src="<?php echo base_url().$page_content->image1;?>"/></div>
							 
						</div>
				</div> 
				  
				<div class="form-group row" >
					<label class="col-form-label col-lg-2"> </label>
					<div class="col-lg-10">
 
					<button type="submit" value="save" name="save" id="save_content" class="btn btn-warning" >Save</button>
						<i id="loadding" style="display:none" class="icon-spinner spinning hide loading"></i>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2"> </label>
					<div class="col-lg-10">
						<div id="survey_msg"><div>
					</div>
				</div>
				<canvas id="canvas" style="display:none"></canvas>
			</form>
            </div>
        </div>
    </div>
    <!-- /basic modals -->

</div> 

<script>

	let image1 = document.getElementById("image1"); 
	let image1_pre = document.getElementById("image1_pre"); 
	
	let canvas = document.getElementById("canvas");
    let context = canvas.getContext('2d');
	
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
		  }

		  src_image.src = this.result;
		});

		reader.readAsDataURL(this.files[0]);
	  }); 
  
	$('#frm_statistic').submit(function (e){
		e.preventDefault();
		var data = new FormData(this);
		$('#loadding').show();
		jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>" + "admin/page/save?page=<?=$page_code?>",
			data : data,
			dataType: 'json',
			cache: false,
			processData: false,
			contentType: false,
			timeout: 60000,
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
