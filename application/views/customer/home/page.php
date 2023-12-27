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
<div class="content wrapper">

  <div class="mb-3">

  </div>

<div class="card">
    <div class="card-body">
	<div class="faqWrap">
		<?php echo @$page_content->content;?>
	</div>
	</div>
 </div>

</div>

