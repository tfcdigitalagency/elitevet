<!-- Page header -->
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><span class="font-weight-semibold">Add Crob-Job Group</span></h4>
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
			<?php $message = $this->session->flashdata('message');
			if($message){
			?>
			<div style="color:blue;">
				<?php echo $message;?>
			</div>
			<?php }?>

        	<form class="form-validate-jquery" id="article_form" method="post" action="<?php echo site_url('marketing/cronjob/add')?>">
        		<input type="text" class="form-control" id="id" name="id" value="" hidden>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Group Name *</label>
					<div class="col-lg-10">
						<input class="form-control" id="pack_name" name="title" placeholder="Group Name" required/>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Description</label>
					<div class="col-lg-10">
						<textarea class="form-control" rows="3" id="description" name="description" placeholder="Description"></textarea>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Number of Emails</label>
					<div class="col-lg-10">
						<?php $options = array(
							10=>'10 Emails',
							20=>'20 Emails',
							30=>'30 Emails'
						)?>
						<select type="number" class="form-control" id="quantity" name="quantity">
							<?php foreach ($options as $k=>$v){
							?>
							<option value="<?php echo $k ?>" <?php echo ($k==10)?'selected':''?>><?php echo $v ?></option>
								<?php
							} ?>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Interval Time</label>
					<div class="col-lg-10">
						<?php $options = array(
							1=>'1 Hour',
							2=>'2 Hours',
							5=>'5 Hours',
							10=>'10 Hours',
							24=>'24 Hours',
						)?>
						<select type="number" class="form-control" id="interval" name="interval">
							<?php foreach ($options as $k=>$v){
								?>
								<option value="<?php echo $k ?>" <?php echo ($k==2)?'selected':''?>><?php echo $v ?></option>
								<?php
							} ?>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Status</label>
					<div class="col-lg-10">
						<select class="form-control" id="status" name="status">
							<option value="1">Enable</option>
							<option value="0">Disabled</option>
						</select>
					</div>
				</div>

				<div class="form-group row" >
					<label class="col-form-label col-lg-2">&nbsp;</label>
					<div class="col-lg-6">
					<button type="button" onclick="save_article()" value="submit" name="submit" class="btn btn-primary" >&nbsp;&nbsp;Submit&nbsp&nbsp; <i style="display: none" class="icon-spinner spinning loading"></i></button>
					<a style="margin-left: 20px;" class="btn btn-default" href="<?php echo site_url('marketing/cronjob')?>">Back</a>
					</div>
				</div>
			</form>
        </div>
    </div>
    <!-- /basic modals -->

</div>
<!-- /content area -->

<script>

	function save_article() {
		 	$('.input_error').removeClass('input_error');
			$('.loading').show();
			if(!$('#pack_name').val()){
				$('#pack_name').addClass('input_error');
				return
			}
			$.ajax({
				url: base_url + 'marketing/cronjob/save_article',
				type : 'POST',
				data : $('#article_form').serialize(),
				cache: false,
				success: function(result) {
					swal({
						title:'Success!',
						text:'Your operation successfully!',
						type:'success',
						confirmButtonClass: 'btn btn-primary',
						confirmButtonText: 'Confirm',
					});

					$('.loading').hide();

					setTimeout(function(){
						document.location = base_url + 'marketing/package'
					}, 5000);
				},
				error: function(){
					new PNotify({
						title: 'ERROR!',
						text: 'Cannot send request correct.',
						icon: 'icon-checkmark3',
						type: 'error'
					});
					$('.loading').hide();
				}
			});

		 
	}

</script>

