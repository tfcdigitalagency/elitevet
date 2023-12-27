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
<div  style="max-width:800px; margin:auto">
	<div style="margin: 20px 0"><strong>Search Results for "<?php echo $key?>"</strong></div>
	<div class="row">
	<?php
		foreach($items as $item){
			$urlImg = $item['photo'];
			if(strpos($urlImg,'https://')=== false){
				$urlImg = base_url().$urlImg;
			}
			$link = (!$dig['type'])?  site_url('/customer/home/document/?id=').$item['id'] : base_url().$item['pdf'];
			
			?>
			<div class="col-md-4">
			<a target="_blank" style="display:inline-block;width:100%;color:#000" class="dig_item" data-id="<?php echo $item['id'] ?>" title="Dig Mag" href="<?php echo $link; ?>">
				<div class="title_pdf"><?php echo $item['title']?></div>
				<div><img style="width:100%;height:100%;" src="<?php echo  $urlImg?>"/></div>
			</a>	
			</div>
			<?php			
		}
	?>
	</div>
</div>
<style>
.title_pdf{
	display: -webkit-box;
-webkit-line-clamp: 3;
-webkit-box-orient: vertical;
overflow: hidden;
text-overflow: ellipsis;
font-weight:bold;
font-size:1.2em;
height: 4em;
}
</style>