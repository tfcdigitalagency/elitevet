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
<div class="col-lg-6 col-md-6">
<div class="header-hero-content">
<img style="margin-top:50px;" src="<?php echo base_url()?>assets/networking.jpg"/>
<h3 class="header-title wow fadeInLeftBig" data-wow-duration="1.3s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1.3s; animation-delay: 0.2s; animation-name: fadeInLeftBig;">The next step!</h3>
<p class="text wow fadeInLeftBig" data-wow-duration="1.3s" data-wow-delay="0.6s" style="visibility: visible; animation-duration: 1.3s; animation-delay: 0.6s; animation-name: fadeInLeftBig;">
<h4>Networking so important!</h4>
Take the next step in helping service-disabled veterans’ business owners. You are on this page for a reason: a sponsor, an advocate or advocate has reached out to you as a support of service-disabled veteran
As business owners, we know how important networking is to help our businesses grow. We are always “on the clock” because we never know when or where we’ll meet our next big customer, teaming partner, or mentor. The Nor Cal Elite Disabled Veteran Network understands how valuable your time is – and organizing quality opportunities and events to help you create meaningful connections is important to us because we know how important it is to you.   
<br/><br/>
<strong>Step two:</strong> refers to a person that might reach out a hand to a Service-disabled veteran

 </p>
<ul style="list-style:none;padding:0;">
<li style="display:inline-block;"></li>
<!--li style="display:inline-block; margin-left:20px;">
<a class="main-btn wow fadeInLeftBig" style="color:#fff;" href="https://linkedin.com/shareArticle?url=https://ncdeliteveterans.org/customer/home/referral&title=The%20next%20step!" target="_blank">Share on LinkedIn</a>
</li-->
 
</ul>

</div> 
</div>
<div class="col-lg-6 col-md-6">
<div class="header-image">

<div class="image-shape">
<div class="divBox">
<video class="videoItem" controls="" autoplay="" name="media"><source src="<?php echo base_url()?>/assets/PromoV3.mp4" type="video/mp4"></video>
<div>
<div style="text-align:center; margin:40px 0 50px 0;">
<a href="#" style="color:#fff" onclick="show_referal()" class="main-btn wow fadeInLeftBig"  style="">Referral Now</a>
</div>
<!-- AddToAny BEGIN -->
<?php $share = get_config_content('referralshare');?>
<div class="a2a_kit a2a_kit_size_32 a2a_default_style" style="margin: auto;width: 190px; text-align:center"> 
<div style="font-size:1.3em;">Share With:</div>
<a class="a2a_button_facebook"></a>
<a class="a2a_button_twitter"></a>
<a class="a2a_button_facebook_messenger"></a>
<a class="a2a_button_linkedin"></a>
</div>
 
<script async src="https://static.addtoany.com/menu/page.js"></script>
<!-- AddToAny END -->
</div>
</div>
<script>
$(document).on('click','.a2a_button_email',function(e){
	e.preventDefault();
	let subject = $(this).data('title');
	let image = $(this).data('image');
	let body = $(this).data('description');
	let content = "<div><img src='"+image+"'/></div>" + body;
	var mailToLink = "mailto:?subject="+subject+"&body=" + encodeURIComponent(body);
	window.location.href = mailToLink;
	return false;
})
</script>
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

function show_referal(){
	$('#referal_modal').modal('show');
}

function make_referal(){
	var email = $('#referal_email').val();
	var name = $('#referal_name').val();
	
	if(!name){
		$('#referal_name').focus();
		return;
	}
	if(!email){
		$('#referal_email').focus();
		return;
	}
	
	var url = document.location;
	url = AddUrlParameter(url,"ref_name",name,true);
	url = AddUrlParameter(url,"ref_email",email,true);
	 
	copyToClipboard(url);
	$('#referal_modal').modal('hide');
	alert("URL has copied successfully.");
}

function send_referal(){
	$('.input_error').removeClass('input_error');
	var email = $('#referal_email').val();
	var name = $('#referal_name').val();
	var from = $('#from_name').val();
	var url = document.location;
	if(!from){
		$('#from_name').focus();
		$('#from_name').addClass('input_error');
		return;
	}
	if(!name){
		$('#referal_name').focus();
		$('#referal_name').addClass('input_error');
		return;
	}
	if(!email || !validateEmail(email)){
		$('#referal_email').focus();
		$('#referal_email').addClass('input_error');
		return;
	}
	$('#send_referal').text('Sending...');
	$.ajax({
			url: '<?php echo site_url("customer/home/send_referral")?>',
			type: 'POST',
			data: 'from=' + from +'&name=' + name +'&email=' + email +'&url='+encodeURIComponent(url),
			dataType:'json',
			success: function (data) {
				$('#send_referal').text('Send');
				$('#referal_modal').modal('hide');
				 alert('Email has been sent successfully.');
			},
			error: function (e) {
				console.log(e.message);
			}
		});
	
	
}

function copyToClipboard(text) {
  // Check if the Clipboard API is available
  if (navigator.clipboard && typeof navigator.clipboard.writeText === 'function') {
    navigator.clipboard.writeText(text)
      .then(() => {
        console.log('Text copied to clipboard');
      })
      .catch((error) => {
        console.error('Error copying text to clipboard:', error);
      });
  } else {
    // Fallback method for older browsers
    const textarea = document.createElement('textarea');
    textarea.value = text;
    textarea.style.position = 'fixed';  // Ensure the element is not visible
    document.body.appendChild(textarea);
    textarea.focus();
    textarea.select();

    try {
      const successful = document.execCommand('copy');
      if (successful) {
        console.log('Text copied to clipboard');
      } else {
        console.error('Unable to copy text to clipboard');
      }
    } catch (error) {
      console.error('Error copying text to clipboard:', error);
    }

    document.body.removeChild(textarea);
  }
}

function AddUrlParameter(sourceUrl, parameterName, parameterValue, replaceDuplicates)
{
	 
    if ((sourceUrl == null) || (sourceUrl.length == 0)) sourceUrl = document.location.href;
    var urlParts = sourceUrl.toString().split("?");
    var newQueryString = "";
    if (urlParts.length > 1)
    {
        var parameters = urlParts[1].split("&");
        for (var i=0; (i < parameters.length); i++)
        {
            var parameterParts = parameters[i].split("=");
            if (!(replaceDuplicates && parameterParts[0] == parameterName))
            {
                if (newQueryString == "")
                    newQueryString = "?";
                else
                    newQueryString += "&";
                newQueryString += parameterParts[0] + "=" + parameterParts[1];
            }
        }
    }
    if (newQueryString == "")
        newQueryString = "?";
    else
        newQueryString += "&";
    newQueryString += parameterName + "=" + parameterValue;

    return urlParts[0] + newQueryString;
}

const validateEmail = (email) => {
  return String(email)
    .toLowerCase()
    .match(
      /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    );
};

</script>
<div class="modal" id="referal_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Send to Friend</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>
			<form>
				<div class="form-group">
					<label for="from_name">From Name </label>
					<input type="text" class="form-control" value="<?php echo $user['name'];?>" id="from_name" placeholder="">
				  </div>
				 <div class="form-group">
					<label for="referal_name">To Name </label>
					<input type="text" class="form-control" id="referal_name" placeholder="">
				  </div>
				  <div class="form-group">
					<label for="referal_email">To Email</label>
					<input type="email" class="form-control" id="referal_email" aria-describedby="emailHelp" placeholder="">					
				  </div>
				  				  
			</form>
		</p>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="send_referal()" id="send_referal" class="btn btn-primary">Send</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>