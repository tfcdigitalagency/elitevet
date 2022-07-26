<style>

	.tablePrice .head{
		padding:10px;
	}
	.tablePrice{
		margin-bottom:40px;
	}
	.tablePrice ul{ margin: 0; padding: 0}
	.tablePrice ul li{
		list-style: none; display: block; width: 100%;
		height: 90px;
		display: flex;
		justify-content: left;
		align-items: center;
		padding: 10px;
	}
	.tablePrice .head{
		height: 120px;
		border-bottom: 1px solid #ccc;
	}
	.tablePrice .ord {
		background: #f1f1f1;
	}
	.pack_name{
		font-size: 18px;
		font-weight: bold;
		text-align: center;
	}
	.pack_price{
		font-size: 28px;
		font-weight: bold;
		text-align: center;
	}
	.tablePrice .col-md-2{
		padding-left: 0;
		padding-right: 0;
		width: 14.2857%;
		flex: 0 0 14.2857%;
		max-width: 14.2857%;
		border-top: 1px solid #ccc;
		border-right: 1px solid #ccc;
		border-bottom: 1px solid #ccc;
	}

	.tablePrice .col-md-2:first-child{
		border-left: 1px solid #ccc;
	}

	.tablePrice .check{
		text-align: center;
		display: block;
		width: 100%;
	}
	.tablePrice .fa-check{
		font-size: 1.1em;
		display: inline-block;
		width: 25px;
		height: 25px;
		border-radius:50% ;
		color: #fff;
		background: #0a6ebd;
		padding: 4px 5px;
	}

	.tablePrice .highlight_pack .fa-check,
	.tablePrice .bg:hover .fa-check{
		font-size: 1.1em;
		display: inline-block;
		width: 25px;
		height: 25px;
		border-radius:50% ;
		color: #0a6ebd;
		background: #fff;
		padding: 4px 5px;
	}

	.tablePrice .action .btn{
		border: 1px solid #fff!important;
	}

	.tablePrice .highlight_pack:before {
		position: absolute;
		background: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iOTMiIGhlaWdodD0iOTMiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIj48cGF0aCBmaWxsPSIjMEY5Qjc0IiBkPSJNNzMuNjAyIDkxLjQxOEg2OC45NFY4NS4yNXpNMS4xODUgMTl2Ni42NjNoOC44OTN6Ii8+PHBhdGggZmlsbD0iIzBDREZBMyIgZD0iTTM3LjA2IDE5bDM2LjU0MiAzNi4zNzd2MzYuMDRMMS4xODUgMTl6Ii8+PHBhdGggZD0iTTI2LjMgMzMuOTc0bDIuNTYzLTIuNTYyIDEuNTEzIDEuNTEzYy43OS43OSAxLjU3IDEuMjIzIDIuMzQ0IDEuMy43NzMuMDc4IDEuNTgtLjMwNCAyLjQyMi0xLjE0NS43Ny0uNzcgMS4xMjYtMS41NTIgMS4wNjgtMi4zNDQtLjA1OC0uNzkzLS40NDUtMS41NDctMS4xNi0yLjI2M2wtMy4xMDMtMy4xMDMtNy4xMjUgNy4xMjUgMS40NzkgMS40OHptNS4xNzgtMi40MDJsLTEuMzg4LTEuMzg4IDIuMDk4LTIuMDk3IDEuMzg4IDEuMzg3Yy4zNS4zNTEuNTQ1LjcwMy41ODIgMS4wNTYuMDM3LjM1My0uMTMuNzE1LS41IDEuMDg1cy0uNzM5LjU0NC0xLjEwNS41MmMtLjM2Ni0uMDI0LS43MjQtLjIxMi0xLjA3NS0uNTYzem0xLjk4NiA5LjkzM2MuOTA2LjkwNiAxLjg1NiAxLjMwNiAyLjg1IDEuMjAxLjk5NC0uMTA0IDEuODc4LS41NDQgMi42NTEtMS4zMTcuNzYtLjc2IDEuMTk3LTEuNjQyIDEuMzEtMi42NDQuMTEzLTEuMDAyLS4yODMtMS45NTYtMS4xODktMi44NjItLjkwNi0uOTA1LTEuODYtMS4zMDEtMi44NjItMS4xODktMS4wMDIuMTEzLTEuODgzLjU1LTIuNjQ0IDEuMzEtLjc3My43NzQtMS4yMTIgMS42NTctMS4zMTcgMi42NTItLjEwNS45OTQuMjk2IDEuOTQ0IDEuMjAxIDIuODV6bTEuMTUtMS4xNmMtLjQwMi0uNDAzLS41NjktLjg1Ni0uNS0xLjM2LjA3LS41MDUuMzY5LTEuMDIxLjg5Ny0xLjU1LjUyOS0uNTI4IDEuMDQ0LS44MjYgMS41NDctLjg5NC41MDMtLjA2OC45NTUuMSAxLjM1OC41MDMuNDAzLjQwMi41Ny44NTQuNSAxLjM1NS0uMDY5LjUwMi0uMzY4IDEuMDE2LS44OTYgMS41NDUtLjUyOS41MjgtMS4wNDQuODI4LTEuNTQ3Ljg5OS0uNTAzLjA3LS45NTUtLjA5NS0xLjM1OC0uNDk4em0xLjk2MyA4LjA1M2wyLjc0Ni0yLjc0NmMtLjA3Ny4zNjgtLjA5OC42ODUtLjA2My45NTMuMDY4LjQ4Ni4zMTEuOTM5LjczIDEuMzU4LjY1Ny42NTcgMS40MzguOTUxIDIuMzQyLjg4Mi45MDQtLjA3IDEuODItLjU2OCAyLjc0OC0xLjQ5Ni44OC0uODggMS4zMzMtMS43NiAxLjM2LTIuNjQyLjAyOC0uODgtLjI2Ni0xLjYzLS44ODItMi4yNDUtLjQyMi0uNDIyLS45MDQtLjY2OC0xLjQ0NS0uNzRhMy4xMjggMy4xMjggMCAwMC0xLjAxNS4wNjhsLjc3OC0uNzc4LTEuMzItMS4zMi03LjM0MiA3LjM0MyAxLjM2MyAxLjM2M3ptNC4yMDYtMS45NTNhMS41NzIgMS41NzIgMCAwMS0uNDctLjkwNGMtLjA3Ny0uNTczLjE5LTEuMTY2LjgwMy0xLjc3OS4zODctLjM4Ni43NTQtLjY1NyAxLjEwMi0uODEyLjY2LS4yODYgMS4yNC0uMTggMS43NC4zMi40MTYuNDE1LjU2Ljg3Mi40MzMgMS4zNy0uMTI3LjQ5OC0uMzk0Ljk1LS44IDEuMzU2LS40OTMuNDkzLS45ODguNzg3LTEuNDg2Ljg4Mi0uNDk4LjA5NS0uOTM5LS4wNS0xLjMyMi0uNDMzem00LjIzOSA2LjQ4MmMuMjcuMjcuNTQyLjQ3Mi44MTQuNjAyLjI3My4xMy42MTMuMjA3IDEuMDIzLjIzLjEzMi4wMS4yNjQgMCAuMzk2LS4wMy4xMzItLjAyOC4yMTMtLjA0NC4yNDItLjA0OGwtLjc0NS43NDUgMS4zNCAxLjMzOSA1LjI2OC01LjI3LTEuMzk3LTEuMzk2LTIuODY2IDIuODY2Yy0uMzM5LjMzOS0uNjU2LjU2Ni0uOTUzLjY4Mi0uNTU0LjIwNi0xLjA2Ni4wNzQtMS41MzctLjM5Ny0uMzY3LS4zNjctLjQ4LS43NDctLjMzOC0xLjE0LjA4LS4yMjMuMjctLjQ4NC41Ny0uNzgzbDMuMTc2LTMuMTc2LTEuNDExLTEuNDEyLTMuMTc2IDMuMTc2Yy0uNjAzLjYwMy0uOTgzIDEuMTM1LTEuMTQgMS41OTUtLjI5LjgzMi0uMDQ2IDEuNjM3LjczNCAyLjQxN3ptNS44MDUgNS41NzRsNy4xMjUtNy4xMjUtMS4zNzgtMS4zNzgtNy4xMjQgNy4xMjUgMS4zNzcgMS4zNzh6bTIuNDcgMi43OThjLjM3NC4zNzQuNzk1LjYyNCAxLjI2Mi43NS4zOTMuMTAzLjc4OC4xNDYgMS4xODQuMTNhNS4xMSA1LjExIDAgMDAtLjI4LjM1OCAyLjE3IDIuMTcgMCAwMC0uMjEzLjM4NmwxLjQ5OCAxLjQ5OS4yMDQtLjIwM2EuNjk4LjY5OCAwIDAxLS4wNDQtLjM2M2MuMDItLjExLjExNC0uMjYuMjg1LS40NS4yMzItLjI0NC40MzItLjQ1LjYtLjYxOGwyLjQxNi0yLjQxN2MuNjM1LS42MzUuODQzLTEuMjkuNjI0LTEuOTY3LS4yMi0uNjc3LS42MTctMS4zMDQtMS4xOTQtMS44OC0uODg2LS44ODctMS43NDMtMS4yOC0yLjU3MS0xLjE4LS41MjYuMDY4LTEuMDMzLjMxNy0xLjUyMy43NWwxLjMzIDEuMzI5Yy4yMzQtLjE3MS40Ni0uMjY4LjY3Ni0uMjkuMjk2LS4wMjYuNjA3LjEyNC45MzMuNDUuMjkuMjkuNDY5LjU1LjUzNi43ODIuMDY4LjIzMi0uMDA2LjQ1Ni0uMjIyLjY3Mi0uMTc3LjE3Ny0uNDA2LjIxLS42ODYuMDk3LS4xNTgtLjA2MS0uMzgtLjIwMy0uNjY3LS40MjZsLS41MjctLjQxYy0uNi0uNDY1LTEuMTE1LS43NTUtMS41NDctLjg3LS43OS0uMjEtMS41MDguMDEtMi4xNTYuNjU3LS41LjUtLjczIDEuMDQtLjY5MSAxLjYyNC4wMzguNTgzLjI5NiAxLjExMy43NzMgMS41OXptMS40MDctLjU5NGExLjA0MiAxLjA0MiAwIDAxLS4zMi0uNjM0Yy0uMDI1LS4yMzUuMDgtLjQ3LjMxNS0uNzA1LjI2NC0uMjY0LjU2Ni0uMzUzLjkwNC0uMjY2LjIuMDUxLjQ3LjE5Ni44MTIuNDM1bC4zNjcuMjUxYy4xODQuMTI2LjMzNy4yMTYuNDYuMjcxLjEyMi4wNTUuMjU0LjA5OC4zOTYuMTNsLS41MTIuNTEzYy0uNDcxLjQ1MS0uOTE4LjYzOS0xLjM0Mi41NjNhMS45ODQgMS45ODQgMCAwMS0xLjA4LS41NTh6bTQuMzQ1IDYuMDE4bDIuNTE5LTIuNTE5Yy40MjItLjQyMi43ODgtLjY4MSAxLjA5Ny0uNzc4LjU1MS0uMTcgMS4xMDQuMDIxIDEuNjU4LjU3NWE1LjEwMiA1LjEwMiAwIDAxLjM3Mi40MmwxLjQxMi0xLjQxYTUuODQgNS44NCAwIDAxLS4xMTItLjEyNiAxLjA0NSAxLjA0NSAwIDAwLS4wNjItLjA2OGMtLjQxMy0uNDEyLS44NTYtLjY0LTEuMzMtLjY4Mi0uMjg2LS4wMjktLjcxMi4wMjYtMS4yNzYuMTY1bC45MTktLjkxOS0xLjMxNS0xLjMxNC01LjI2OSA1LjI2OCAxLjM4NyAxLjM4OHoiIGZpbGw9IiNGRkYiIGZpbGwtcnVsZT0ibm9uemVybyIvPjwvZz48L3N2Zz4=);
		width: 93px;
		height: 93px;
		top: -24px;
		right: -24px;
		content: "";
		z-index: 10;
	}


	.tablePrice .highlight_pack,
	.tablePrice .bg:hover{
		position: relative;
		top: 0px;
		border: 1px solid #999!important;
		-webkit-box-shadow: 5px 5px 15px 5px rgba(0,0,0,0.4);
		box-shadow: 5px 5px 15px 5px rgba(0,0,0,0.4);
		z-index: 99;
		border-radius: 5px 5px 0 0;-

	}
	.tablePrice .highlight_pack,
	.tablePrice .highlight_pack .ord,
	.tablePrice .bg:hover .head,
	.tablePrice .bg:hover li{
		background:#294dff!important;
		color: #fff;
		z-index: 10;
		text-align: center;

	}

	.tablePrice .action{
		display: block;
		margin-top: 10px;
		text-align: center;
	}

	.swiper-slide a {
		display: block;
		height: 100%;
		display: flex;
		align-items: center;
		height: 100px;
		padding-top: 15px;
	}

	.swiper-container .swiper-slide img {
		width: auto;
		max-height: 90px!important;
	}

	.swiper-slide img {
		vertical-align: middle;
		border-style: none;
		object-fit: revert;
	}

	@media screen and (max-width: 667px){
		.tablePrice .col-md-2{
			padding-left: 0;
			padding-right: 0;
			width: 95%;
			flex: 0 0 95%;
			max-width: 95%;
			border: 1px solid #ccc!important;
			border-right: 1px solid #ccc!important;
			margin-bottom: 30px;
			margin: 10px;
			border-radius: 10px;
		}

		.tablePrice ul li {
			display: block;
			text-align: center;
		}

	}
</style>
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

<main class="clearfix width-100 mt-5">
	<div class="fusion-row" style="max-width:100%;">
		<section id="content" class="full-width" style="margin-top: 10px;">
			<div class="container-fluid" style="max-width: 1600px">
				<h1>Benefit </h1>
				<div class="tablePrice">
					 <div class="row">
						 <div class="col-md-2 hidemobile">
							 <div class="head">
								 <div class="title" style="position: relative;top:40px; padding-left: 10px;">Registrations</div>
							 </div>
							 <div>
								 <ul>
									 <li class="ord">Virtual Exhibitor Table</li>
									 <li>Event Program Ad</li>
									 <li class="ord">Logo on Conference Website</li>
									 <li>Recognition as a Veteran Business</li>
									 <li class="ord">Attendee Registration Sponsor</li>
									 <li>Recognition at Expo</li>
									 <li class="ord">Virtual Business Matchmaking</li>
									 <li>Logo on Event Program</li>
									 <li class="ord">Wheel of Opportunity Slice</li>
									 <li>Logo on Virtual Expo Welcome Sign</li>
									 <li class="ord">Include material in event packets</li>
									 <li>Logo as a seminar sponsor</li>
									 <li class="ord">Raffle gift for Expo</li>
									 <li>Logo Ad on Nor-Cal Elite App</li>
									 <li class="ord">Participate in VIP Advocacy webinars</li>
									 <li>Nor-Cal Elite Annual Corporate Membership</li>
									 <li class="ord">Logo on main Nor-Cal Elite website</li>
									 <li>Logo on Nor-Cal Elite Network Newsletter</li>
									 <li class="ord">Assist with Nor-Cal Elite Directory searches</li>
									 <li>Logo as a Nor-Cal Elite Directory Sponsor</li>
									 <li class="ord">Assist with posting</li>
									 <li>events & opportunities</li>
								 </ul>
							 </div>
						 </div>
						 <div class="col-md-2 bg bg1">
							 <div class="head">
								 <div class="pack_name">Courage</div>
								 <div class="pack_price">$15,000</div>
								 <div class="action"><a href="<?php echo site_url('customer/contact?pack=1')?>" class="btn btn-primary text-white">Register</a></div>
							 </div>
							 <div>
								 <ul>
									 <li class="ord"><div class="hidedesktop">Virtual Exhibitor Table</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li><div class="hidedesktop">Event Program Ad</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="ord"><div class="hidedesktop">Logo on Conference Website</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li><div class="hidedesktop">Recognition as a Veteran Business</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="ord"><div class="hidedesktop">Attendee Registration Sponsor</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li><div class="hidedesktop">Recognition at Expo</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="ord"><div class="hidedesktop">Virtual Business Matchmaking</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li><div class="hidedesktop">Logo on Event Program</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="ord"><div class="hidedesktop">Wheel of Opportunity Slice</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li><div class="hidedesktop">Logo on Virtual Expo Welcome Sign</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="ord"><div class="hidedesktop">Include material in event packets</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li><div class="hidedesktop">Logo as a seminar sponsor</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="ord"><div class="hidedesktop">Raffle gift for Expo</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li><div class="hidedesktop">Logo Ad on Nor-Cal Elite App</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="ord"><div class="hidedesktop">Participate in VIP Advocacy webinars</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li><div class="hidedesktop">Nor-Cal Elite Annual Corporate Membership</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="ord"><div class="hidedesktop">Logo on main Nor-Cal Elite website</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li><div class="hidedesktop">Logo on Nor-Cal Elite Network Newsletter</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="ord"><div class="hidedesktop">Assist with Nor-Cal Elite Directory searches</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li><div class="hidedesktop">Logo as a Nor-Cal Elite Directory Sponsor</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="ord"><div class="hidedesktop">Assist with posting</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li><div class="hidedesktop">events & opportunities</div><div class="check"><i class="fa fa-check"></i></div></li>
								 </ul>
							 </div>
						 </div>
						 <div class="col-md-2 bg bg2 highlight_pack">
							 <div class="head">
								 <div class="pack_name">Exellance</div>
								 <div class="pack_price">$10,000</div>
								 <div class="action"><a href="<?php echo site_url('customer/contact?pack=2')?>" class="btn btn-primary text-white">Register</a></div>
							 </div>
							 <div>
								 <ul>
									 <li class="ord"><div class="hidedesktop">Virtual Exhibitor Table</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li><div class="hidedesktop">Event Program Ad</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="ord"><div class="hidedesktop">Logo on Conference Website</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li><div class="hidedesktop">Recognition as a Veteran Business</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="ord"><div class="hidedesktop">Attendee Registration Sponsor</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li><div class="hidedesktop">Recognition at Expo</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="ord"><div class="hidedesktop">Virtual Business Matchmaking</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li><div class="hidedesktop">Logo on Event Program</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="ord"><div class="hidedesktop">Wheel of Opportunity Slice</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li><div class="hidedesktop">Logo on Virtual Expo Welcome Sign</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="ord"><div class="hidedesktop">Include material in event packets</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li><div class="hidedesktop">Logo as a seminar sponsor</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="ord"><div class="hidedesktop">Raffle gift for Expo</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li><div class="hidedesktop">Logo Ad on Nor-Cal Elite App</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="ord"><div class="hidedesktop">Participate in VIP Advocacy webinars</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li><div class="hidedesktop">Nor-Cal Elite Annual Corporate Membership</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="ord"><div class="hidedesktop">Logo on main Nor-Cal Elite website</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li><div class="hidedesktop">Logo on Nor-Cal Elite Network Newsletter</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="ord"><div class="hidedesktop">Assist with Nor-Cal Elite Directory searches</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="hidemobile"><div class="hidedesktop">Logo as a Nor-Cal Elite Directory Sponsor</div><div class="check"></div></li>
									 <li class="ord hidemobile"><div class="hidedesktop">Assist with posting</div><div class="check"></div></li>
									 <li class="hidemobile"><div class="hidedesktop">events & opportunities</div><div class="check"></div></li>
								 </ul>
							 </div>
						 </div>
						 <div class="col-md-2 bg bg3">
							 <div class="head">
								 <div class="pack_name">Integarity</div>
								 <div class="pack_price">$5,000</div>
								 <div class="action"><a href="<?php echo site_url('customer/contact?pack=3')?>" class="btn btn-primary text-white">Register</a></div>
							 </div>
							 <div>
								 <ul>
									 <li class="ord"><div class="hidedesktop">Virtual Exhibitor Table</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li><div class="hidedesktop">Event Program Ad</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="ord"><div class="hidedesktop">Logo on Conference Website</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li><div class="hidedesktop">Recognition as a Veteran Business</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="ord"><div class="hidedesktop">Attendee Registration Sponsor</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li><div class="hidedesktop">Recognition at Expo</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="ord"><div class="hidedesktop">Virtual Business Matchmaking</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li><div class="hidedesktop">Logo on Event Program</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="ord"><div class="hidedesktop">Wheel of Opportunity Slice</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li><div class="hidedesktop">Logo on Virtual Expo Welcome Sign</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="ord"><div class="hidedesktop">Include material in event packets</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li><div class="hidedesktop">Logo as a seminar sponsor</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="ord"><div class="hidedesktop">Raffle gift for Expo</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li><div class="hidedesktop">Logo Ad on Nor-Cal Elite App</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="ord"><div class="hidedesktop">Participate in VIP Advocacy webinars</div><div class="check"></div></li>
									 <li><div class="hidedesktop">Nor-Cal Elite Annual Corporate Membership</div><div class="check"></div></li>
									 <li class="ord"><div class="hidedesktop">Logo on main Nor-Cal Elite website</div><div class="check"></div></li>
									 <li><div class="hidedesktop">Logo on Nor-Cal Elite Network Newsletter</div><div class="check"></div></li>
									 <li class="ord"><div class="hidedesktop">Assist with Nor-Cal Elite Directory searches</div><div class="check"></div></li>
									 <li class="hidemobile"><div class="hidedesktop">Logo as a Nor-Cal Elite Directory Sponsor</div><div class="check"></div></li>
									 <li class="ord hidemobile"><div class="hidedesktop">Assist with posting</div><div class="check"></div></li>
									 <li class="hidemobile"><div class="hidedesktop">events & opportunities</div><div class="check"></div></li>
								 </ul>
							 </div>
						 </div>
						 <div class="col-md-2 bg bg4">
							 <div class="head">
								 <div class="pack_name">Honnor</div>
								 <div class="pack_price">$1,500</div>
								 <div class="action"><a href="<?php echo site_url('customer/contact?pack=4')?>" class="btn btn-primary text-white">Register</a></div>
							 </div>
							 <div>
								 <ul>
									 <li class="ord"><div class="hidedesktop">Virtual Exhibitor Table</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li><div class="hidedesktop">Event Program Ad</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="ord"><div class="hidedesktop">Logo on Conference Website</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li><div class="hidedesktop">Recognition as a Veteran Business</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="ord"><div class="hidedesktop">Attendee Registration Sponsor</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li><div class="hidedesktop">Recognition at Expo</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="ord"><div class="hidedesktop">Virtual Business Matchmaking</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li><div class="hidedesktop">Logo on Event Program</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="ord"><div class="hidedesktop">Wheel of Opportunity Slice</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li><div class="hidedesktop">Logo on Virtual Expo Welcome Sign</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="ord"><div class="hidedesktop">Include material in event packets</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li><div class="hidedesktop">Logo as a seminar sponsor</div><div class="check"></div></li>
									 <li class="ord"><div class="hidedesktop">Raffle gift for Expo</div><div class="check"></div></li>
									 <li><div class="hidedesktop">Logo Ad on Nor-Cal Elite App</div><div class="check"></div></li>
									 <li class="ord"><div class="hidedesktop">Participate in VIP Advocacy webinars</div><div class="check"></div></li>
									 <li><div class="hidedesktop">Nor-Cal Elite Annual Corporate Membership</div><div class="check"></div></li>
									 <li class="ord"><div class="hidedesktop">Logo on main Nor-Cal Elite website</div><div class="check"></div></li>
									 <li><div class="hidedesktop">Logo on Nor-Cal Elite Network Newsletter</div><div class="check"></div></li>
									 <li class="ord"><div class="hidedesktop">Assist with Nor-Cal Elite Directory searches</div><div class="check"></div></li>
									 <li class="hidemobile"><div class="hidedesktop">Logo as a Nor-Cal Elite Directory Sponsor</div><div class="check"></div></li>
									 <li class="ord hidemobile"><div class="hidedesktop">Assist with posting</div><div class="check"></div></li>
									 <li class="hidemobile"><div class="hidedesktop">events & opportunities</div><div class="check"></div></li>
								 </ul>
							 </div>
						 </div>
						 <div class="col-md-2 bg bg5">
							 <div class="head">
								 <div class="pack_name">Loyalty</div>
								 <div class="pack_price">$200</div>
								 <div class="action"><a href="<?php echo site_url('customer/contact?pack=5')?>" class="btn btn-primary text-white">Register</a></div>
							 </div>
							 <div>
								 <ul>
									 <li class="ord"><div class="hidedesktop">Virtual Exhibitor Table</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li><div class="hidedesktop">Event Program Ad</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="ord"><div class="hidedesktop">Logo on Conference Website</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li><div class="hidedesktop">Recognition as a Veteran Business</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="ord"><div class="hidedesktop">Attendee Registration Sponsor</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li><div class="hidedesktop">Recognition at Expo</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="ord"><div class="hidedesktop">Virtual Business Matchmaking</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li><div class="hidedesktop">Logo on Event Program</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="ord"><div class="hidedesktop">Wheel of Opportunity Slice</div><div class="check"></div></li>
									 <li><div class="hidedesktop">Logo on Virtual Expo Welcome Sign</div><div class="check"></div></li>
									 <li class="ord"><div class="hidedesktop">Include material in event packets</div><div class="check"></div></li>
									 <li><div class="hidedesktop">Logo as a seminar sponsor</div><div class="check"></div></li>
									 <li class="ord"><div class="hidedesktop">Raffle gift for Expo</div><div class="check"></div></li>
									 <li><div class="hidedesktop">Logo Ad on Nor-Cal Elite App</div><div class="check"></div></li>
									 <li class="ord"><div class="hidedesktop">Participate in VIP Advocacy webinars</div><div class="check"></div></li>
									 <li><div class="hidedesktop">Nor-Cal Elite Annual Corporate Membership</div><div class="check"></div></li>
									 <li class="ord"><div class="hidedesktop">Logo on main Nor-Cal Elite website</div><div class="check"></div></li>
									 <li><div class="hidedesktop">Logo on Nor-Cal Elite Network Newsletter</div><div class="check"></div></li>
									 <li class="ord"><div class="hidedesktop">Assist with Nor-Cal Elite Directory searches</div><div class="check"></div></li>
									 <li class="hidemobile"><div class="hidedesktop">Logo as a Nor-Cal Elite Directory Sponsor</div><div class="check"></div></li>
									 <li class="ord hidemobile"><div class="hidedesktop">Assist with posting</div><div class="check"></div></li>
									 <li class="hidemobile"><div class="hidedesktop">events & opportunities</div><div class="check"></div></li>
								 </ul>
							 </div>
						 </div>
						 <div class="col-md-2 bg bg6">
							 <div class="head">
								 <div class="pack_name">Commitment</div>
								 <div class="pack_price">$60</div>
								 <div class="action"><a href="<?php echo site_url('customer/contact?pack=6')?>" class="btn btn-primary text-white">Register</a></div>
							 </div>
							 <div>
								 <ul>
									 <li class="ord"><div class="hidedesktop">Virtual Exhibitor Table</div><div class="check"></div></li>
									 <li><div class="hidedesktop">Event Program Ad</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="ord"><div class="hidedesktop">Logo on Conference Website</div><div class="check"></div></li>
									 <li><div class="hidedesktop">Recognition as a Veteran Business</div><div class="check"></div></li>
									 <li class="ord"><div class="hidedesktop">Attendee Registration Sponsor</div><div class="check"></div></li>
									 <li><div class="hidedesktop">Recognition at Expo</div><div class="check"></div></li>
									 <li class="ord"><div class="hidedesktop">Virtual Business Matchmaking</div><div class="check"></div></li>
									 <li><div class="hidedesktop">Logo on Event Program</div><div class="check"></div></li>
									 <li class="ord"><div class="hidedesktop">Wheel of Opportunity Slice</div><div class="check"></div></li>
									 <li><div class="hidedesktop">Logo on Virtual Expo Welcome Sign</div><div class="check"></div></li>
									 <li class="ord"><div class="hidedesktop">Include material in event packets</div><div class="check"></div></li>
									 <li><div class="hidedesktop">Logo as a seminar sponsor</div><div class="check"></div></li>
									 <li class="ord"><div class="hidedesktop">Raffle gift for Expo</div><div class="check"></div></li>
									 <li><div class="hidedesktop">Logo Ad on Nor-Cal Elite App</div><div class="check"></div></li>
									 <li class="ord"><div class="hidedesktop">Participate in VIP Advocacy webinars</div><div class="check"></div></li>
									 <li><div class="hidedesktop">Nor-Cal Elite Annual Corporate Membership</div><div class="check"></div></li>
									 <li class="ord"><div class="hidedesktop">Logo on main Nor-Cal Elite website</div><div class="check"></div></li>
									 <li><div class="hidedesktop">Logo on Nor-Cal Elite Network Newsletter</div><div class="check"></div></li>
									 <li class="ord"><div class="hidedesktop">Assist with Nor-Cal Elite Directory searches</div><div class="check"></div></li>
									 <li class="hidemobile"><div class="hidedesktop">Logo as a Nor-Cal Elite Directory Sponsor</div><div class="check"></div></li>
									 <li class="ord hidemobile"><div class="hidedesktop">Assist with posting</div><div class="check"></div></li>
									 <li class="hidemobile"><div class="hidedesktop">events & opportunities</div><div class="check"></div></li>
								 </ul>
							 </div>
						 </div>
					 </div>
				</div>
				<h2 style="margin-top: 40px;">Sponsors</h2>
				<div style="background: #fff; border-radius:5px; padding: 5px 15px; " class="elementor-element elementor-element-719f574 elementor-widget elementor-widget-image-carousel"
					 data-id="719f574" data-element_type="widget" data-settings="{&quot;slides_to_show&quot;:&quot;6&quot;,&quot;navigation&quot;:&quot;none&quot;,&quot;autoplay&quot;:&quot;yes&quot;,&quot;pause_on_hover&quot;:&quot;yes&quot;,&quot;pause_on_interaction&quot;:&quot;yes&quot;,&quot;autoplay_speed&quot;:5000,&quot;infinite&quot;:&quot;yes&quot;,&quot;speed&quot;:500,&quot;direction&quot;:&quot;ltr&quot;}"
					 data-widget_type="image-carousel.default">
					<div class="elementor-widget-container">
						<div class="elementor-image-carousel-wrapper swiper-container mySwiper swiper-container-initialized swiper-container-horizontal"
							 dir="ltr">
							<div class="elementor-image-carousel  swiper-wrapper" style="transition-duration: 0ms; transform: translate3d(-1840px, 0px, 0px);">
								<?php $count = 0;?>
								<?php foreach($sponsor as $item):?>
									<div class="swiper-slide"
										 data-swiper-slide-index="<?=$count;?>" style="width: 230px;">
										<figure class="swiper-slide-inner">
											<a href="<?php echo $item['url']?$item['url']:'#'?>" target="_blank">
												<img class="swiper-slide-image" src="<?=base_url().$item['icon']?>"
													 alt="<?=$item['name']?>">
											</a>
										</figure>
									</div>
									<?php $count++;?>
								<?php endforeach;?>
							</div>
							<span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
						</div>
					</div>
				</div>
				<script>
					$(document).ready(function (){
						var swiper = new Swiper(".mySwiper", {
							slidesPerView: 10,
							spaceBetween: 20,
							freeMode: true,
							pagination: {
								el: ".swiper-pagination",
								clickable: true,
							},
						});
					})

				</script>
			</div>
	</div>

</main>  <!-- #main -->

