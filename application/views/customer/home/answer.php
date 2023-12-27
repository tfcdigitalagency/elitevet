<style>
.header-hero {
    height: 900px;
}
.header-hero {
    position: relative;
    z-index: 5;
    background-position: bottom center;
    height: 800px;
}
.bg_cover {
    background-position: center center;
    background-size: cover;
    background-repeat: no-repeat;
    width: 100%;
    height: 100%;
}

.a2a_svg { 
    height: 42px!important; 
    width: 42px!important;
}

@media (max-width: 767px) {
    .header-hero {
        height:auto
    }
}

.header-hero .shape {
    position: absolute
}

@media (max-width: 767px) {
    .header-hero .shape {
        display:none
    }
}

.header-hero .shape.shape-1 {
    width: 75px;
    height: 75px;
    background: -webkit-linear-gradient(rgba(254,132,100,.5) 0%,rgba(254,110,154,.5) 100%);
    background: -o-linear-gradient(rgba(254,132,100,.5) 0%,rgba(254,110,154,.5) 100%);
    background: linear-gradient(rgba(254,132,100,.5) 0%,rgba(254,110,154,.5) 100%);
    border-radius: 50%;
    left: 130px;
    top: 25%;
    -webkit-animation: animation1 2s linear infinite;
    -moz-animation: animation1 2s linear infinite;
    -o-animation: animation1 2s linear infinite;
    animation: animation1 2s linear infinite
}

.header-hero .shape.shape-2 {
    width: 39px;
    height: 39px;
    background: -webkit-linear-gradient(rgba(51,200,193,.5) 0%,rgba(17,155,210,.5) 100%);
    background: -o-linear-gradient(rgba(51,200,193,.5) 0%,rgba(17,155,210,.5) 100%);
    background: linear-gradient(rgba(51,200,193,.5) 0%,rgba(17,155,210,.5) 100%);
    left: 150px;
    bottom: 40px;
    border-radius: 50%;
    -webkit-animation: animation1 2s linear infinite;
    -moz-animation: animation1 2s linear infinite;
    -o-animation: animation1 2s linear infinite;
    animation: animation1 2s linear infinite
}

.header-hero .shape.shape-3 {
    width: 19px;
    height: 19px;
    background: -webkit-linear-gradient(rgba(54,28,193,.5) 0%,rgba(46,130,239,.5) 100%);
    background: -o-linear-gradient(rgba(54,28,193,.5) 0%,rgba(46,130,239,.5) 100%);
    background: linear-gradient(rgba(54,28,193,.5) 0%,rgba(46,130,239,.5) 100%);
    bottom: 25%;
    left: 26%;
    border-radius: 50%;
    -webkit-animation: animation1 2s linear infinite;
    -moz-animation: animation1 2s linear infinite;
    -o-animation: animation1 2s linear infinite;
    animation: animation1 2s linear infinite
}

.header-hero .shape.shape-4 {
    background-color: rgba(226,158,25,.55);
    width: 39px;
    height: 39px;
    border-radius: 50%;
    top: 175px;
    left: 40%;
    -webkit-animation: animation1 2s linear infinite;
    -moz-animation: animation1 2s linear infinite;
    -o-animation: animation1 2s linear infinite;
    animation: animation1 2s linear infinite
}

.header-hero .shape.shape-5 {
    width: 19px;
    height: 19px;
    background-color: rgba(108,99,255,.55);
    left: 50%;
    -webkit-transform: translateX(-50%);
    -moz-transform: translateX(-50%);
    -ms-transform: translateX(-50%);
    -o-transform: translateX(-50%);
    transform: translateX(-50%);
    bottom: 20%;
    border-radius: 50%;
    -webkit-animation: animation1 2s linear infinite;
    -moz-animation: animation1 2s linear infinite;
    -o-animation: animation1 2s linear infinite;
    animation: animation1 2s linear infinite
}

.header-hero .shape.shape-6 {
    width: 14px;
    height: 14px;
    background-color: rgba(235,163,26,.55);
    border-radius: 50%;
    left: 45%;
    bottom: 70px;
    -webkit-animation: animation1 2s linear infinite;
    -moz-animation: animation1 2s linear infinite;
    -o-animation: animation1 2s linear infinite;
    animation: animation1 2s linear infinite
}
.header-hero-content .header-title {
    font-size: 42px;
    color: #38424d;
	font-weight:bold;
}
.header-hero-content .header-title span {
    display: contents;
    color: #0898e7;
}
.header-hero-content .main-btn {
    margin-top: 10px;
}
.main-btn {
    display: inline-block;
    font-weight: 500;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    border: 2px solid #0898e7;
    padding: 0 25px;
    font-size: 16px;
    height: 55px;
    line-height: 51px;
    border-radius: 5px;
    color: #fff;
    cursor: pointer;
    z-index: 5;
    -webkit-transition: all .4s ease-out 0s;
    -moz-transition: all .4s ease-out 0s;
    -ms-transition: all .4s ease-out 0s;
    -o-transition: all .4s ease-out 0s;
    transition: all .4s ease-out 0s;
    background-color: #0898e7;
}

.fadeInLeftBig {
    -webkit-animation-name: fadeInLeftBig;
    animation-name: fadeInLeftBig;
}


element.style {
}
.header-shape-1 {
    position: absolute;
    top: 0;
    width: 50%;
    height: 100%;
    right: 0;
    z-index: -1;
    background-image: url(<?php echo base_url()?>assets/image/header-shape-1.svg);
    background-position: left center;
    background-repeat: no-repeat;
    background-size: cover;
}
.videoItem{
	width:100%;
	height:350px;
	margin-top:50px;
	
}
.input_error{
	border:1px solid red;
}
.divBox{
	 
}
</style>
<div id="home" class="header-hero bg_cover">
<div class="shape shape-1"></div>
<div class="shape shape-2"></div>
<div class="shape shape-3"></div>
<div class="shape shape-4"></div>
<div class="shape shape-5"></div>
<div class="shape shape-6"></div>
<div class="container">
<div class="row">
<div class="col-lg-12">
<div class="header-hero-content">
 <h1 style="margin-top:40px;">Questionnaire</h1>
 <form id="fromQestion">
 <input type="hidden" value="<?php echo $hash?>" name="hash"/>
	<?php 
	if($questions['question']){
		if($email && $user){
			echo '<input type="hidden" value="'.$email.'" name="email"/>';
		}else{
			?>
			<div class="form-group">
					<label for="referal_email">Your Email</label>
					<input type="email" class="form-control" id="email" name="email" value="<?php echo $email?>" aria-describedby="emailHelp" placeholder="">					
				  </div>
			<?php
		}
	$aryQuestions = explode("\n",$questions['question']);
	foreach($aryQuestions as $k=>$q){
		?>
			<div class="form-group">
					<h2 for="referal_email"><?php echo $k+1?>.<?php echo $q?><input type="hidden" value="<?php echo $q?>" name="questions[]"></h2>
					<textarea class="form-control" rows="5" name="answer[]" placeholder="Answer"></textarea>				
			</div>
		<?php
	}
	?>
	<div class="form-group"><button style="width:150px;" type="button" onclick="save_answer()" id="save_question" class="btn btn-primary">Send</button></div>
	<?php
	//print_r($questions);
	}else{
		?>
		<div style="color:red">Sorry, Invalid data.</div>
		<?php
	}
	?>
 </form> 
</div> 
</div> 
</div>
 
</div>
</div> 
</div>
</div> 
</div> 
<div class="header-shape-1 d-none d-md-block"></div> 
 
</div>
<div style="margin:100px; text-align:center">
 
</div>
<?php //print_r($user);?>
<script>
 

function save_answer(){
	 
	$('#save_question').text('Sending...');
	$.ajax({
			url: '<?php echo site_url("customer/home/save_answer")?>',
			type: 'POST',
			data: $('#fromQestion').serialize(),
			dataType:'json',
			success: function (data) {
				$('#send_referal').text('Send');
				$('#referal_modal').modal('hide');
				 alert('Your answers has been sent successfully. Thank you.');
				 $('#fromQestion').trigger("reset");
			},
			error: function (e) {
				console.log(e.message);
			}
		});
	
	
} 
 
</script>
 