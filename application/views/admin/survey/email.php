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
            <h4><span class="font-weight-semibold">Send Survey without Login</span></h4>
        </div>
    </div>
</div>
<!-- /page header -->

<!-- Content area -->
<div class="content">
	<?php
		$config = $this->db->get_where('tbl_config',array('code'=>'SURVEY'))->row();
		if($config) {
			$data = json_decode($config->detail);
		}
	?>
    <!-- Basic modals -->
    <div class="card">
        <div class="card-body">

            <div class="col-md-12">
                 <form class="form-validate-jquery" method="post" id="sendEmail" action="<?php echo site_url('admin/survey/sendemail')?>">
					 <div class="form-group row">
						 <label class="col-form-label col-lg-2">Type</label>
						 <div class="col-lg-10">
							 <select type="text" class="select2-choice form-control" name="type" id="type" >
								 <option value="">All Members</option>
								 <option value="1">Individual</option>
							 </select>
							 <div id="individual_wrap" style="margin-top: 30px; display: none;">
								 <div><input type="text" class="form-control" placeholder="Filter by Name" id="filter"/></div>
								 <div class="membersList" style="max-height: 300px; margin-top: 10px; overflow-y: auto;">
									 <?php foreach ($users as $u):
										 ?>
									 <div><label><input type="checkbox" value="<?php echo $u['id']?>" name="user[]"/> <?php echo $u['name']?> (<?php echo $u['email']?>)</label></div>
									 <?php endforeach;?>
								 </div>
							 </div>
						 </div>
					 </div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Subject *</label>
					<div class="col-lg-10">
						<input type="text" class="form-control" value="<?php echo @$data->subject; ?>" name="subject" id="subject" required/>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Email content *</label>
					<div class="col-lg-10">
						<textarea rows="5" cols="3" class="form-control" id="content" name="content" placeholder="Please Enter content" required><?php echo @$data->content; ?></textarea>
					</div>
				</div>
				<div class="form-group row" >
					<label class="col-form-label col-lg-2"> </label>
					<div class="col-lg-10">
					<button type="submit" value="submit" name="submit" class="btn btn-primary" >&nbsp;&nbsp;Submit</button> &nbsp;
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


<script>
	$('#type').change(function (){
		var val = $(this).val();
		if(val){
			$('#individual_wrap').show();
		}else{
			$('#individual_wrap').hide();
		}
	})

	$('#filter').keyup(function(){
		var sSearch = this.value;
		$('.membersList > div').hide();
		$('.membersList > div:contains("' + sSearch + '")').show();
	});

	var sending = false;
	$('#sendEmail').submit(function(e){
		e.preventDefault();
		if(sending){
			return false;
		}
		sending = true;
		$('#loadding').show();
		$('#survey_msg').html('<i class="icon-spinner spinning hide loading"></i>Sending...').show();
		jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "admin/survey/sendemail",
                data: $('#sendEmail').serialize() ,
                dataType: 'json',
                success: function (res) {
					sending = false;
					$('#loadding').hide();
					$('#survey_msg').html(res.message).show();
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
		$('#loadding').show();
		jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>" + "admin/survey/save",
			data: $('#sendEmail').serialize() ,
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
