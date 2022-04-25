<!-- Page header -->
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><span class="font-weight-semibold">New Question</span></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
<!-- /page header -->

<!-- Content area -->
<div class="content">

    <?php
        $today = new DateTime();
        $tomorrow = $today->modify('+1 day');
    ?>

    <!-- Basic modals -->
    <div class="card">        
        <div class="card-body">
			<?php $message = $this->session->flashdata('message');
			if($message){
			?>
			<div style="color:blue;">
				<?php echo $message;?>
			</div>
			<?php }?>
		
        	<form class="form-validate-jquery" method="post" action="<?php echo site_url('admin/survey/add')?>">
        		<input type="text" class="form-control" id="survey_id" name="survey_id" value="" hidden>
	             
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Question *</label>
					<div class="col-lg-10">
						<textarea rows="5" cols="3" class="form-control" id="question" name="question" placeholder="Please Input Question" required></textarea>
					</div>
				</div>
				 
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">Type</label>
                    <div class="col-lg-6">
                        <select class="form-control" id="type"  name="type" required>
                        	<option value="">Select</option>
                        	<option value="1">Pick One</option>
                        	<option value="2">Pick Multiple</option>
                        	<option value="3">Rate</option>
                        </select>
                    </div> 
                </div>
				<div class="form-group row" id="question_choise" style="display:none;">
					<label class="col-form-label col-lg-2">Question Choise</label>
					<div class="col-lg-6">
						<div class="item">
							<input type="text" class="form-control" name="choise[]"/> 
						</div>
						<div class="item">
							<input type="text" class="form-control" name="choise[]"/> 
						</div>
						<div class="question_wrap">
						<div class="item">
							<input type="text" class="form-control" name="choise[]"/>
							<a class="remove"><i class="icon-trash"></i></a>
						</div>
						<div class="item">
							<input type="text" class="form-control" name="choise[]"/>
							<a class="remove"><i class="icon-trash"></i></a>
						</div>
						</div>
						<div>
							<a id="addMore"> More</a>
						</div>
					</div>
				</div>
				<div class="form-group row" style="float: right;">					
					<button type="submit" value="submit" name="submit" class="btn btn-primary" >&nbsp;&nbsp;Submit&nbsp&nbsp; <i class="icon-spinner spinning hide loading"></i></button>
				</div>
			</form>
        </div>
    </div>
    <!-- /basic modals -->

</div>
<!-- /content area -->

<style>
#addMore{
	cursor:pointer;
	display:inline-block;
	border:1px solid #ccc;
	padding:3px 15px;
	margin-top:5px;
}
.item{
	position:relative;
	margin-top:5px;
}
.item .remove{
	position:absolute;
	top:6px;
	right:-25px;
	cursor:pointer;
}
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
      $(document).on('click','#type',function(){
		 var t = parseInt($(this).val());
		  
		 switch(t){
			 case 1:
			 case 2:
			 case 3:
				$('#question_choise').show();
				break;
			default:
				$('#question_choise').hide();
				break;
		 }
	  }); 
	  
	  $(document).on('click','.item .remove',function(){
		  $(this).parents('.item').remove();
	  });
	  
	  $(document).on('click','#addMore',function(){
		   var html = '<div class="item"> <input type="text" class="form-control" name="choise[]"/> <a class="remove"><i class="icon-trash"></i></a></div>';
		   $('.question_wrap').append(html);
	  });

</script>
<iframe name="_other" id="_other" hidden></iframe>