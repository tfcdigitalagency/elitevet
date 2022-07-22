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
	}
	.tablePrice .ord {
		background: #ccc;
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
	.fa-check{
		font-size: 1.1em;
		display: inline-block;
		width: 25px;
		height: 25px;
		border-radius:50% ;
		color: #fff;
		background: #0a6ebd;
		padding: 4px 5px;
	}

	.tablePrice .action .btn{
		border: 1px solid #fff!important;
	}

	.bg1:hover,
	.bg2:hover,
	.bg3:hover,
	.bg4:hover,
	.bg5:hover,
	.bg6:hover{
		position: relative;
		top: -10px;
		border: 1px solid #999!important;
		-webkit-box-shadow: 5px 5px 15px 5px rgba(0,0,0,0.4);
		box-shadow: 5px 5px 15px 5px rgba(0,0,0,0.4);
		z-index: 99;
		border-radius: 5px 5px 0 0;-
		background: lightcyan;
	}

	.bg1 .head{
		background:#e67e22;
		color: #fff;
	}
	.bg2 .head{
		background:#3498db;
		color: #fff;
	}
	.bg3 .head{
		background:#2ecc71;
		color: #fff;
	}
	.bg4 .head{
		background:#9b59b6;
		color: #fff;
	}
	.bg5 .head{
		background:#FF0000;
		color: #fff;
	}
	.bg6 .head{
		background:#0000FF;
		color: #fff;
	}

	.action{
		display: block;
		margin-top: 10px;
		text-align: center;
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
<main class="clearfix width-100 mt-5">
	<div class="fusion-row" style="max-width:100%;">
		<section id="content" class="full-width" style="margin-top: 10px;">
			<div class="container">
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
									 <li>Logo Ad on VIB App</li>
									 <li class="ord">Participate in VIP Advocacy webinars</li>
									 <li>VIB Annual Corporate Membership</li>
									 <li class="ord">Logo on main VIB website</li>
									 <li>Logo on VIB Network Newsletter</li>
									 <li class="ord">Assist with VIB Directory searches</li>
									 <li>Logo as a VIB Directory Sponsor</li>
									 <li class="ord">Assist with posting</li>
									 <li>events & opportunities</li>
								 </ul>
							 </div>
						 </div>
						 <div class="col-md-2 bg1">
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
									 <li><div class="hidedesktop">Logo Ad on VIB App</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="ord"><div class="hidedesktop">Participate in VIP Advocacy webinars</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li><div class="hidedesktop">VIB Annual Corporate Membership</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="ord"><div class="hidedesktop">Logo on main VIB website</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li><div class="hidedesktop">Logo on VIB Network Newsletter</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="ord"><div class="hidedesktop">Assist with VIB Directory searches</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li><div class="hidedesktop">Logo as a VIB Directory Sponsor</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="ord"><div class="hidedesktop">Assist with posting</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li><div class="hidedesktop">events & opportunities</div><div class="check"><i class="fa fa-check"></i></div></li>
								 </ul>
							 </div>
						 </div>
						 <div class="col-md-2 bg2">
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
									 <li><div class="hidedesktop">Logo Ad on VIB App</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="ord"><div class="hidedesktop">Participate in VIP Advocacy webinars</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li><div class="hidedesktop">VIB Annual Corporate Membership</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="ord"><div class="hidedesktop">Logo on main VIB website</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li><div class="hidedesktop">Logo on VIB Network Newsletter</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="ord"><div class="hidedesktop">Assist with VIB Directory searches</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="hidemobile"><div class="hidedesktop">Logo as a VIB Directory Sponsor</div><div class="check"></div></li>
									 <li class="ord hidemobile"><div class="hidedesktop">Assist with posting</div><div class="check"></div></li>
									 <li class="hidemobile"><div class="hidedesktop">events & opportunities</div><div class="check"></div></li>
								 </ul>
							 </div>
						 </div>
						 <div class="col-md-2 bg3">
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
									 <li><div class="hidedesktop">Logo Ad on VIB App</div><div class="check"><i class="fa fa-check"></i></div></li>
									 <li class="ord"><div class="hidedesktop">Participate in VIP Advocacy webinars</div><div class="check"></div></li>
									 <li><div class="hidedesktop">VIB Annual Corporate Membership</div><div class="check"></div></li>
									 <li class="ord"><div class="hidedesktop">Logo on main VIB website</div><div class="check"></div></li>
									 <li><div class="hidedesktop">Logo on VIB Network Newsletter</div><div class="check"></div></li>
									 <li class="ord"><div class="hidedesktop">Assist with VIB Directory searches</div><div class="check"></div></li>
									 <li class="hidemobile"><div class="hidedesktop">Logo as a VIB Directory Sponsor</div><div class="check"></div></li>
									 <li class="ord hidemobile"><div class="hidedesktop">Assist with posting</div><div class="check"></div></li>
									 <li class="hidemobile"><div class="hidedesktop">events & opportunities</div><div class="check"></div></li>
								 </ul>
							 </div>
						 </div>
						 <div class="col-md-2 bg4">
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
									 <li><div class="hidedesktop">Logo Ad on VIB App</div><div class="check"></div></li>
									 <li class="ord"><div class="hidedesktop">Participate in VIP Advocacy webinars</div><div class="check"></div></li>
									 <li><div class="hidedesktop">VIB Annual Corporate Membership</div><div class="check"></div></li>
									 <li class="ord"><div class="hidedesktop">Logo on main VIB website</div><div class="check"></div></li>
									 <li><div class="hidedesktop">Logo on VIB Network Newsletter</div><div class="check"></div></li>
									 <li class="ord"><div class="hidedesktop">Assist with VIB Directory searches</div><div class="check"></div></li>
									 <li class="hidemobile"><div class="hidedesktop">Logo as a VIB Directory Sponsor</div><div class="check"></div></li>
									 <li class="ord hidemobile"><div class="hidedesktop">Assist with posting</div><div class="check"></div></li>
									 <li class="hidemobile"><div class="hidedesktop">events & opportunities</div><div class="check"></div></li>
								 </ul>
							 </div>
						 </div>
						 <div class="col-md-2 bg5">
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
									 <li><div class="hidedesktop">Logo Ad on VIB App</div><div class="check"></div></li>
									 <li class="ord"><div class="hidedesktop">Participate in VIP Advocacy webinars</div><div class="check"></div></li>
									 <li><div class="hidedesktop">VIB Annual Corporate Membership</div><div class="check"></div></li>
									 <li class="ord"><div class="hidedesktop">Logo on main VIB website</div><div class="check"></div></li>
									 <li><div class="hidedesktop">Logo on VIB Network Newsletter</div><div class="check"></div></li>
									 <li class="ord"><div class="hidedesktop">Assist with VIB Directory searches</div><div class="check"></div></li>
									 <li class="hidemobile"><div class="hidedesktop">Logo as a VIB Directory Sponsor</div><div class="check"></div></li>
									 <li class="ord hidemobile"><div class="hidedesktop">Assist with posting</div><div class="check"></div></li>
									 <li class="hidemobile"><div class="hidedesktop">events & opportunities</div><div class="check"></div></li>
								 </ul>
							 </div>
						 </div>
						 <div class="col-md-2 bg6">
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
									 <li><div class="hidedesktop">Logo Ad on VIB App</div><div class="check"></div></li>
									 <li class="ord"><div class="hidedesktop">Participate in VIP Advocacy webinars</div><div class="check"></div></li>
									 <li><div class="hidedesktop">VIB Annual Corporate Membership</div><div class="check"></div></li>
									 <li class="ord"><div class="hidedesktop">Logo on main VIB website</div><div class="check"></div></li>
									 <li><div class="hidedesktop">Logo on VIB Network Newsletter</div><div class="check"></div></li>
									 <li class="ord"><div class="hidedesktop">Assist with VIB Directory searches</div><div class="check"></div></li>
									 <li class="hidemobile"><div class="hidedesktop">Logo as a VIB Directory Sponsor</div><div class="check"></div></li>
									 <li class="ord hidemobile"><div class="hidedesktop">Assist with posting</div><div class="check"></div></li>
									 <li class="hidemobile"><div class="hidedesktop">events & opportunities</div><div class="check"></div></li>
								 </ul>
							 </div>
						 </div>
					 </div>
				</div>
			</div>
	</div>

</main>  <!-- #main -->

