<!-- Page header -->
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><span class="font-weight-semibold">Add Package</span></h4>
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

        	<form class="form-validate-jquery" id="article_form" method="post" action="<?php echo site_url('marketing/package/add')?>">
        		<input type="text" class="form-control" id="article_id" name="article_id" value="" hidden>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Package Name *</label>
					<div class="col-lg-10">
						<input class="form-control" id="pack_name" name="pack_name" placeholder="Please Input Name" required/>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Description</label>
					<div class="col-lg-10">
						<textarea class="form-control" rows="3" id="description" name="description" placeholder="Description"></textarea>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Basic price</label>
					<div class="col-lg-10">
						<input type="number" class="form-control" id="price" name="price" placeholder="Minimum price"/>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Package Unit</label>
					<div class="col-lg-10">
						<input type="text" class="form-control" id="unit" name="unit" placeholder="Unit"/>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Popular</label>
					<div class="col-lg-10">
						<label><input type="radio" value="1" id="popular1" name="popular" /> Yes</label>
						<label><input type="radio" value="0" id="popular2" checked name="popular" /> No</label>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Status</label>
					<div class="col-lg-10">
						<select class="form-control" id="status" name="status">
							<option value="1">Active</option>
							<option value="0">Disable</option>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Options Detail</label>
					<div id="packOptionWrap" class="col-lg-10">
						<div class="packOption row">
							<div class="col-12"><label class="font-weight-bold">Option <span class="row_no"></span></label></div>
							<div class="col-3">
								<input title="Option name" type="text" class="form-control row_option" id="pack_name" name="detail[options][]" value="" placeholder="Option name"/>
							</div>
							<div class="col-2" style="position:relative">
								<input title="Pricce" type="number" class="form-control row_price" id="pack_price" name="detail[price][]" value="" placeholder="Price"/><span style="position: absolute; top: 6px; right: 18px;">$</span>
							</div>
							<div class="col-2">
								<input title="Note" type="text" class="form-control row_note" id="pack_note" name="detail[note][]" value="" placeholder="Note"/>
							</div>
							<div class="col-1 row_optional_wrap">
								<label style="margin-top: 8px"><input type="checkbox" class="row_optional" /> Required</label>
								<input type="hidden" class="form-control row_required_value"  name="detail[require][]" value="" />
							</div>
							<div class="col-2">
								<a class="add_item cursor-pointer font-size-lg"><i class="fa fa-plus-circle"></i></a>
								<a class="remove_item cursor-pointer font-size-lg"><i class="fa fa-trash-o"></i></a>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group row" >
					<label class="col-form-label col-lg-2">&nbsp;</label>
					<div class="col-lg-6">
					<button type="button" onclick="save_article()" value="submit" name="submit" class="btn btn-primary" >&nbsp;&nbsp;Submit&nbsp&nbsp; <i style="display: none" class="icon-spinner spinning loading"></i></button>
					<a style="margin-left: 20px;" class="btn btn-default" href="<?php echo site_url('marketing/package')?>">Back</a>
					</div>
				</div>
			</form>
        </div>
    </div>
    <!-- /basic modals -->
	<template id="packTemplate">
		<div class="packOption row">
			<div class="col-12"><label class="font-weight-bold">Option <span class="row_no"></span></label></div>
			<div class="col-3">
				<input title="Option name" type="text" class="form-control row_option" id="pack_name" name="detail[options][]" value="" placeholder="Option name"/>
			</div>
			<div class="col-2" style="position:relative">
				<input title="Pricce" type="number" class="form-control row_price" id="pack_price" name="detail[price][]" value="" placeholder="Price"/><span style="position: absolute; top: 6px; right: 18px;">$</span>
			</div>
			<div class="col-2">
				<input title="Note" type="text" class="form-control row_note" id="pack_note" name="detail[note][]" value="" placeholder="Note"/>
			</div>
			<div class="col-1 row_optional_wrap">
				<label style="margin-top: 8px"><input type="checkbox" class="row_optional" /> Required</label>
				<input type="hidden" class="form-control row_required_value"  name="detail[require][]" value="" />
			</div>
			<div class="col-2">
				<a class="add_item cursor-pointer font-size-lg"><i class="fa fa-plus-circle"></i></a>
				<a class="remove_item cursor-pointer font-size-lg"><i class="fa fa-trash-o"></i></a>
			</div>
		</div>
	</template>
</div>
<!-- /content area -->

<script>

	$(document).ready(function() {
		let template = $('#packTemplate').html()
		$(document).on('click','.add_item', function(){
			$(this).closest('.packOption').after(template)
			update_options_label()
		})
		$(document).on('click','.remove_item', function(){
			var count = $("#packOptionWrap").children().length;
			if(count>1){
				$(this).closest('.packOption').remove()
			}
			update_options_label()
		})

		$(document).on('click','.row_optional',function(){
			var val =  $(this).is(':checked') ? 1:0;
			$(this).closest('.row_optional_wrap').find('.row_required_value').val(val)
		})
	})

	function update_options_label() {
		$("#packOptionWrap .row_no").each(function(index){
			$(this).html(index+1)
		})
	}

	function save_article() {
		 	$('.input_error').removeClass('input_error');
			$('.loading').show();
			if(!$('#pack_name').val()){
				$('#pack_name').addClass('input_error');
				return
			}
			$.ajax({
				url: base_url + 'marketing/package/save_article',
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

