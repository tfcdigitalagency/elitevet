<?php

?>
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

</style>
<div class="content wrapper">

  <div class="mb-3">
    <h1 class="mb-0 font-weight-semibold" style="color:red">
     <?php echo @$page_content->title;?>
    </h1>
  </div>

<div class="card">
    <div class="card-body">
	<div class="faqWrap">
		<?php echo @$page_content->content;?>
	</div>
	</div>
 </div>

</div>
