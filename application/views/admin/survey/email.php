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

    <!-- Basic modals -->
    <div class="card">        
        <div class="card-body">
              
            <div class="col-md-12">
                 <form class="form-validate-jquery" method="post" id="sendEmail" action="<?php echo site_url('admin/survey/sendemail')?>">
        		 
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Subject *</label>
					<div class="col-lg-10">
						<input type="text" class="form-control" value="Webinar Online Survey" name="subject" id="subject" required/>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Email content *</label>
					<div class="col-lg-10">
						<textarea rows="5" cols="3" class="form-control" id="content" name="content" placeholder="Please Enter content" required></textarea>
					</div>
				</div> 
				<div class="form-group row" >
					<label class="col-form-label col-lg-2"> </label>
					<div class="col-lg-10">				
					<button type="submit" value="submit" name="submit" class="btn btn-primary" >&nbsp;&nbsp;Submit&nbsp&nbsp; <i id="loadding" style="display:none" class="icon-spinner spinning hide loading"></i></button>
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
  
</script>