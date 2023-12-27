<?php
$dig = get_dig($_GET['id']);
//	print_r($dig); die();
if($dig->cid){
	?>
	<script> document.location = "<?php echo $dig->pdf ?>";</script>
	<?php
}else{
?>
<style>
html,body{
	padding:0;
	margin:0;
	width:100%;
	height:100%;
}
</style>
<div style="position:relative">
<div style="    background: #fff;
    position: absolute;
    top: 11px;
    margin-left: 180px;
    left: 50%;
    z-index: 999;
    padding: 3px 10px;
    border-radius: 10px;"><a onclick="showModal()" style="cursor:pointer" data-bs-toggle="modal" data-bs-target="#modalsearch"><i class="fa fa-search"></i> Search</a></div>
</div>
<div class="modal fade" id="modalsearch" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">       
      <div class="modal-body">
        <form action="<?php echo site_url('customer/home/search_pdf')?>" method="GET">
		<div class="input-group">
		  <div class="form-outline" style="width: 90%;">
			<input type="search" id="s" name="s" placeholder="Keyword..." class="form-control" /> 
		  </div>
		  <button type="submit" class="btn btn-primary">
			<i class="fa fa-search"></i>
		  </button>
		</div>
		
		</form>
      </div>       
    </div>
  </div>
</div>
<script>
function showModal(){
	$('#modalsearch').modal('show');
}
</script>
<?php 
if($dig->pdf){
	$link = strpos($dig->pdf, "http") !== false?$dig->pdf : base_url().$dig->pdf;	
}else{
	$link = $dig->pdf_view;
}

//print_r($dig);die($pdf);

?><!--iframe id="iframe1" style="width:100%;height:100%; min-height:750px;" src="https://docs.google.com/gview?url=<?php echo urlencode($link);?>&embedded=true#:0.page.20"></iframe-->
<iframe style="width:100%;height:100%; min-height:750px;" src="<?php echo $link;?>"  seamless="seamless" scrolling="no" frameborder="0" allowtransparency="true" allowfullscreen="true" ></iframe>
<?php }?>