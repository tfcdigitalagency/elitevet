<!-- Page header -->
<div class="page-header page-header-light">
	<div class="page-header-content header-elements-md-inline">
		<div class="page-title d-flex">
			<h4><span class="font-weight-semibold">Update Company Type</span></h4>
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
			<div class="row">
			<div class="col-md-7">
			<form class="form-validate-jquery" id="article_form" method="post" action="<?php echo site_url('admin/aicategory/edit')?>">
				<input type="text" class="form-control" id="article_id" name="article_id" value="<?php echo $data['id']; ?>" hidden>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Name *</label>
					<div class="col-lg-10">
						<input class="form-control" id="name" name="name" placeholder="Please Input Title" value="<?php echo $data['name']; ?>" readonly />
					</div>
				</div>
				 <div class="form-group row">
					<label class="col-form-label col-lg-2">Score</label>
					<div class="col-lg-10" id="image_1">
						<input type="text" class="form-control"  name="score" id="score" value="<?php echo $data['score']; ?>" readonly />
					</div>					 
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Company Type</label>
					<div class="col-lg-10" >
						 <select  class="form-control" id="type" name="type" >
							<option value="">Select</option>
							<?php foreach($company_type as $type){
								?>
								<option <?php echo ($type['id'] == $data['type'])?'selected':'' ?> value="<?php echo $type['id']?>"><?php echo $type['title']?></option>
								<?php
								
							}?>
						</select>
					</div>
					 
				</div>
				 
				<div class="form-group row" >
					<label class="col-form-label col-lg-2">&nbsp;</label>
					<div class="col-lg-6">
						<a href="<?php echo site_url('admin/aicategory/')?>" value="Back" name="Back" class="btn btn-warning" >&nbsp;&nbsp;Back&nbsp&nbsp;</a>
						<button type="button" onclick="save_article()" value="submit" name="submit" class="btn btn-primary" >&nbsp;&nbsp;Submit&nbsp&nbsp; <i style="display: none" class="icon-spinner spinning loading"></i></button>
					</div>
				</div>
			</form>
			</div>
			<div class="col-md-5"></div>
			</div>
		</div>
	</div>
	<!-- /basic modals -->

</div>
<!-- /content area -->

 

<script>
	var base_url = '<?= base_url() ?>';
	var validator;
	 
	var modalTemplate;
	var previewZoomButtonClasses;
	var previewZoomButtonIcons;
	var fileActionSettings;
 

	jQuery(document).ready(function() {
		 
		 
		 
	});
 

	function save_article() {
	 
			$('.loading').show();
			 
			var A = new FormData($('#article_form')[0]); 
			 
			var C = new XMLHttpRequest();
			C.open("POST", base_url + 'admin/aicategory/save_article');
			C.onreadystatechange = function () {
				$('.loading').hide();
				if (C.readyState == 4) {
					if (C.status == 200) {
						new PNotify({
							title: 'SUCCESS!',
							text: 'The Operation is correct.',
							icon: 'icon-checkmark3',
							type: 'success'
						});
					}else{
						new PNotify({
							title: 'ERROR!',
							text: 'Canot send request correct.',
							icon: 'icon-checkmark3',
							type: 'error'
						});
					}
				}
			};
			C.send(A);
		 
	}

</script>
<iframe name="_other" id="_other" hidden></iframe>
