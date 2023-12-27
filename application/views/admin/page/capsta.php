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
	<?php
	$config_data = get_config_content('CAPSTA');
	//print_r($config_data);
	?>
    <!-- Basic modals -->
    <div class="card">
        <div class="card-body">

            <div class="col-md-12">
                 <form class="form-validate-jquery" method="post" id="config_page" action="">
				<p><b>Please select sponsor level for user can download Cap-Sta document.</b></p>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Platinum</label>
					<div class="col-lg-10">
						<input type="checkbox" class="form-control" <?php echo (in_array('Platinum',$config_data->candownload))?'checked':''?> value="Platinum" name="candownload[]"/>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Gold</label>
					<div class="col-lg-10">
						<input type="checkbox" class="form-control" <?php echo (in_array('Gold',$config_data->candownload))?'checked':''?> value="Gold" name="candownload[]"/>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Silver</label>
					<div class="col-lg-10">
						<input type="checkbox" class="form-control" <?php echo (in_array('Silver',$config_data->candownload))?'checked':''?> value="Silver" name="candownload[]"/>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Bronze</label>
					<div class="col-lg-10">
						<input type="checkbox" class="form-control" <?php echo (in_array('Bronze',$config_data->candownload))?'checked':''?> value="Bronze" name="candownload[]"/>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Trailblazer</label>
					<div class="col-lg-10">
						<input type="checkbox" class="form-control" <?php echo (in_array('Trailblazer',$config_data->candownload))?'checked':''?> value="Trailblazer" name="candownload[]"/>
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
<script>

	$('#save_content').click(function (){ 
		$('#loadding').show();
		jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>" + "admin/page/save?page=<?=$page_code?>",
			data :  $('#config_page').serialize(),
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
