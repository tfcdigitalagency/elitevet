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
                 <form class="form-validate-jquery" method="post" id="frm_statistic" action="<?php echo site_url('admin/ads/sendemail')?>">

				<div class="form-group row">
					<label class="col-form-label col-lg-2">Page title *</label>
					<div class="col-lg-10">
						<input type="text" class="form-control" value="<?php echo @$page_content->title; ?>" name="title" id="title" required/>
					</div>
				</div>
				
				<fieldset style="border:1px solid #ccc; border-radius:10px; padding:10px;">
					<legend style="display: inline-block; width: inherit; border:0;padding:5px; margin:5px;">Users</legend>
						<div class="row">
						<div class="col-md-12">Leave blank to read data direct from Database</div>
						<div class="col-md-4">
						<div class="form-group row">
							<label class="col-form-label col-lg-12">Disable veterans</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" placeholder="Live"
								value="<?php echo @$page_content->disable_veterans; ?>" 
								name="disable_veterans"/>
							</div>
						</div>
						</div>
						<div class="col-md-4">
						<div class="form-group row">
							<label class="col-form-label col-lg-12">Corporate companies</label>
							<div class="col-lg-10">
								<input type="text" class="form-control"   placeholder="Live"
								value="<?php echo @$page_content->corporate_companies; ?>" 
								name="corporate_companies"/>
							</div>
						</div>
						</div>
						<div class="col-md-4">
						<div class="form-group row">
							<label class="col-form-label col-lg-12">Veterans</label>
							<div class="col-lg-10">
								<input type="text" class="form-control"  placeholder="Live"
								value="<?php echo @$page_content->veterans; ?>" 
								name="veterans"/>
							</div>
						</div>
						</div>
						</div>
				 </fieldset>
				 
				 <fieldset style="border:1px solid #ccc; border-radius:10px; padding:10px;">
					<legend style="display: inline-block; width: inherit; border:0;padding:5px; margin:5px;">Website visitor</legend>
						<div class="row">
						<div class="col-md-4">
						<div class="form-group row">
							<label class="col-form-label col-lg-12">Digital Magazine Hit</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" 
								value="<?php echo @$page_content->visitor_chrome; ?>" 
								name="visitor_chrome"/>
							</div>
						</div>
						</div>
						<div class="col-md-4">
						<div class="form-group row">
							<label class="col-form-label col-lg-12">Bids Posted This Year</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" 
								value="<?php echo @$page_content->visitor_firefox; ?>" 
								name="visitor_firefox"/>
							</div>
						</div>
						</div>
						<div class="col-md-4">
						<div class="form-group row">
							<label class="col-form-label col-lg-12">Contract Wins</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" 
								value="<?php echo @$page_content->visitor_other; ?>" 
								name="visitor_other"/>
							</div>
						</div>
						</div>
						</div>
				 </fieldset>
				 
				 <fieldset style="border:1px solid #ccc; border-radius:10px; padding:10px;">
					<legend style="display: inline-block; width: inherit; border:0;padding:5px; margin:5px;">Cap-sta</legend>
						<div class="row">
						<div class="col-md-12">
						<div class="form-group row">
							<label class="col-form-label col-lg-12">Cap-sta title</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" 
								value="<?php echo @$page_content->cap_sta; ?>" 
								name="cap_sta"/>
							</div>
						</div>
						</div>
						<div class="col-md-12">
						<div class="form-group row">
							<label class="col-form-label col-lg-12">Cap-sta description</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" 
								value="<?php echo @$page_content->cap_sta_description; ?>" 
								name="cap_sta_description"/>
							</div>
						</div>
						</div> 
						</div>
				 </fieldset>
				 
				 <fieldset style="border:1px solid #ccc; border-radius:10px; padding:10px;">
					<legend style="display: inline-block; width: inherit; border:0;padding:5px; margin:5px;">Bids</legend>
						<div class="row">
						<div class="col-md-12">
						<div class="form-group row">
							<label class="col-form-label col-lg-12">Title</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" 
								value="<?php echo @$page_content->bid_title; ?>" 
								name="bid_title"/>
							</div>
						</div>
						</div> 
						<div class="col-md-12">
						<div class="form-group row">
							<label class="col-form-label col-lg-12">Description</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" 
								value="<?php echo @$page_content->bid_description; ?>" 
								name="bid_description"/>
							</div>
						</div>
						</div> 
						</div>
				 </fieldset>
				 
				 <fieldset style="border:1px solid #ccc; border-radius:10px; padding:10px;">
					<legend style="display: inline-block; width: inherit; border:0;padding:5px; margin:5px;">Emails</legend>
						<div class="row">
						<div class="col-md-12">
						<div class="form-group row">
							<label class="col-form-label col-lg-12">Title</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" 
								value="<?php echo @$page_content->email_title; ?>" 
								name="email_title"/>
							</div>
						</div>
						</div> 
						<div class="col-md-12">
						<div class="form-group row">
							<label class="col-form-label col-lg-12">Description</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" 
								value="<?php echo @$page_content->email_description; ?>" 
								name="email_description"/>
							</div>
						</div>
						</div> 
						</div>
				 </fieldset>
				 
				 <fieldset style="border:1px solid #ccc; border-radius:10px; padding:10px;">
					<legend style="display: inline-block; width: inherit; border:0;padding:5px; margin:5px;">Images</legend>
						<div class="row">
						<div class="col-md-12">
						<div class="form-group row">
							<label class="col-form-label col-lg-3">Pdf Document</label>
							<div class="col-lg-9">
								<input type="file" name="pdf" id="pdf">
								<?php if($page_content->pdf){ echo '<a href="'.base_url().$page_content->pdf.'" target="_blank">'.str_replace('assets/uploads/sponsorad/','',$page_content->pdf).'</a>';}?>
							</div>
						</div>
						</div>
						</div>
						<div class="row">
						<div class="col-md-12">
						<div class="form-group row">
							<label class="col-form-label col-lg-3">Image1</label>
							<div class="col-lg-9">
								<input type="file" name="image1" id="image1">								 
								<div style="display:<?=$page_content->image1?'':'none'?>"><img id="image1_pre" style="width:150px; height:150px;" src="<?php echo base_url().$page_content->image1;?>"/></div>
							</div>
						</div>
						</div>
						<div class="col-md-12">
						<div class="form-group row">
							<label class="col-form-label col-lg-3">Image2</label>
							<div class="col-lg-9">
								<input type="file" name="image2" id="image2">
								<div style="display:<?=$page_content->image2?'':'none'?>"><img id="image2_pre" style="width:150px; height:150px;" src="<?php echo base_url().$page_content->image2;?>"/></div>
							</div>
						</div>
						</div>
						<div class="col-md-12">
						<div class="form-group row">
							<label class="col-form-label col-lg-3">Image3</label>
							<div class="col-lg-9">
								<input type="file" name="image3" id="image3">
								<div style="display:<?=$page_content->image3?'':'none'?>"><img id="image3_pre" style="width:150px; height:150px;" src="<?php echo base_url().$page_content->image3;?>"/></div>
							</div>
						</div>
						</div>
						<div class="col-md-12">
						<div class="form-group row">
							<label class="col-form-label col-lg-3">Image4</label>
							<div class="col-lg-9">
								<input type="file" name="image4" id="image4">
								<div style="display:<?=$page_content->image4?'':'none'?>"><img id="image4_pre" style="width:150px; height:150px;" src="<?php echo base_url().$page_content->image4;?>"/></div>
							</div>
						</div>
						</div>						
						</div>
				 </fieldset>
				
				
				<div class="form-group row" >
					<label class="col-form-label col-lg-2"> </label>
					<div class="col-lg-10">
<!--					<button type="submit" value="submit" name="submit" class="btn btn-primary" >&nbsp;&nbsp;Submit</button> &nbsp;-->
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
	let image2 = document.getElementById("image2");
	let image3 = document.getElementById("image3");
	let image4 = document.getElementById("image4");
	let image1_pre = document.getElementById("image1_pre");
    let image2_pre = document.getElementById("image2_pre");
    let image3_pre = document.getElementById("image3_pre");
    let image4_pre = document.getElementById("image4_pre");
	
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
		  }

		  src_image.src = this.result;
		});

		reader.readAsDataURL(this.files[0]);
	  });
	  
	  image3.addEventListener("change", function() {
		var reader = new FileReader();

		reader.addEventListener("loadend", function(arg) {
		  var src_image = new Image();

		  src_image.onload = function() {
			canvas.height = src_image.height;
			canvas.width = src_image.width;
			context.drawImage(src_image, 0, 0);
			var imageData = canvas.toDataURL("image/png"); 
			image3_pre.src = imageData; 
		  }

		  src_image.src = this.result;
		});

		reader.readAsDataURL(this.files[0]);
	  });
	  
	  image4.addEventListener("change", function() {
		var reader = new FileReader();

		reader.addEventListener("loadend", function(arg) {
		  var src_image = new Image();

		  src_image.onload = function() {
			canvas.height = src_image.height;
			canvas.width = src_image.width;
			context.drawImage(src_image, 0, 0);
			var imageData = canvas.toDataURL("image/png"); 
			image4_pre.src = imageData; 
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
			url: "<?php echo base_url(); ?>" + "admin/webinar_statistic/save?page=<?=$page_code?>",
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
