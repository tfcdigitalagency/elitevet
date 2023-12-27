 <link rel="stylesheet" id="statistic-css" href="/assets/statistic/style.css?t=<?=time()?>" type="text/css" media="all">
<div data-elementor-type="wp-page" data-elementor-id="10" class="elementor elementor-10" data-elementor-settings="[]">
    <div class="elementor-inner">
        <div class="elementor-section-wrap">
            <div class="content-wrapper">
                <!-- Content area -->
                <div class="container">

                    <!-- Layout 1 -->
                    <div class="mb-3">

                    </div>
                    <div style="">
                    	 <h2 class="text-center mb-3" style="font-size:3em; font-weight:bold;color:#000;"><?=$statistic->title?></h3>
						 <div class="row">
						 <div class="col-md-6">
						 <div class="white_card card_height_100 mb_30 social_media_card">
<div class="white_card_header">
<div class="main-title">
<h3 class="m-0" style="padding:30px;"><?= number_format($total_user,0,'',',') ?>+ users in data base</h3>
<span></span>
</div>
</div>
<div class="media_thumb ml_25">
<img src="/assets/statistic/img/media.svg" alt="">
</div>
<div class="media_card_body">
<div class="media_card_list">
<div class="single_media_card">
<span>Disable veterans</span>
<h3><?=$statistic->disable_veterans?$statistic->disable_veterans:number_format($total_dis_vet,0,'',',')?> </h3>
</div>
<div class="single_media_card">
<span>Corporate companies</span>
<h3><?=$statistic->corporate_companies?$statistic->corporate_companies:number_format($total_corp,0,'',',')?></h3>
</div>
<div class="single_media_card">
<span>Veterans</span>
<h3><?=$statistic->veterans?$statistic->veterans:number_format($total_vet,0,'',',')?></h3>
</div> 
</div>
</div>
</div>
</div>
<div class="col-md-6">
<div class="white_card card_height_100 mb_30">
<div class="white_card_header">
<div class="box_header m-0">
<div class="main-title">
<h3 class="m-0">Total visitors</h3>
<span><?php echo number_format(get_counter(),0,'',',');?> website hits</span>
</div>
<div class="float-lg-right float-none common_tab_btn justify-content-end">
</div>
</div>
</div>
<div class="white_card white_card_body" style="position: relative;">
<div id="chart-currently" style="min-height: 165px;"><div id="apexchartsonmldpq8g" class="apexcharts-canvas apexchartsonmldpq8g light" style="width: 451px; height: 150px;"><svg id="SvgjsSvg1208" width="451" height="150" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1210" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 30)"><defs id="SvgjsDefs1209"><clipPath id="gridRectMaskonmldpq8g"><rect id="SvgjsRect1214" width="455" height="84" x="-2" y="-2" rx="0" ry="0" fill="#ffffff" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect></clipPath><clipPath id="gridRectMarkerMaskonmldpq8g"><rect id="SvgjsRect1215" width="453" height="82" x="-1" y="-1" rx="0" ry="0" fill="#ffffff" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect></clipPath><linearGradient id="SvgjsLinearGradient1221" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop1222" stop-opacity="0.7" stop-color="rgba(136,79,251,0.7)" offset="0"></stop><stop id="SvgjsStop1223" stop-opacity="0.5" stop-color="rgba(255,255,255,0.5)" offset="0.8"></stop><stop id="SvgjsStop1224" stop-opacity="0.5" stop-color="rgba(255,255,255,0.5)" offset="1"></stop></linearGradient></defs><line id="SvgjsLine1213" x1="412.9166666666667" y1="0" x2="412.9166666666667" y2="80" stroke="#b6b6b6" stroke-dasharray="3" class="apexcharts-xcrosshairs" x="412.9166666666667" y="0" width="1" height="80" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line><g id="SvgjsG1227" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG1228" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"></g></g><g id="SvgjsG1230" class="apexcharts-grid"><line id="SvgjsLine1232" x1="0" y1="80" x2="451" y2="80" stroke="transparent" stroke-dasharray="0"></line><line id="SvgjsLine1231" x1="0" y1="1" x2="0" y2="80" stroke="transparent" stroke-dasharray="0"></line></g><g id="SvgjsG1217" class="apexcharts-area-series apexcharts-plot-series"><g id="SvgjsG1218" class="apexcharts-series" seriesName="series1" data:longestSeries="true" rel="1" data:realIndex="0"><path id="SvgjsPath1225" d="M 0 80L 0 80C 13.154166666666667 80 24.429166666666667 53.33333333333333 37.583333333333336 53.33333333333333C 50.737500000000004 53.33333333333333 62.0125 60 75.16666666666667 60C 88.32083333333334 60 99.59583333333333 26.666666666666664 112.75 26.666666666666664C 125.90416666666667 26.666666666666664 137.17916666666667 56 150.33333333333334 56C 163.4875 56 174.7625 53.33333333333333 187.91666666666666 53.33333333333333C 201.07083333333333 53.33333333333333 212.34583333333333 56 225.5 56C 238.65416666666667 56 249.92916666666665 49.33333333333333 263.0833333333333 49.33333333333333C 276.2375 49.33333333333333 287.5125 56 300.6666666666667 56C 313.8208333333333 56 325.09583333333336 33.333333333333336 338.25 33.333333333333336C 351.40416666666664 33.333333333333336 362.6791666666667 40 375.8333333333333 40C 388.9875 40 400.2625 6.666666666666671 413.4166666666667 6.666666666666671C 426.5708333333333 6.666666666666671 437.84583333333336 80 451 80C 451 80 451 80 451 80M 451 80z" fill="url(#SvgjsLinearGradient1221)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskonmldpq8g)" pathTo="M 0 80L 0 80C 13.154166666666667 80 24.429166666666667 53.33333333333333 37.583333333333336 53.33333333333333C 50.737500000000004 53.33333333333333 62.0125 60 75.16666666666667 60C 88.32083333333334 60 99.59583333333333 26.666666666666664 112.75 26.666666666666664C 125.90416666666667 26.666666666666664 137.17916666666667 56 150.33333333333334 56C 163.4875 56 174.7625 53.33333333333333 187.91666666666666 53.33333333333333C 201.07083333333333 53.33333333333333 212.34583333333333 56 225.5 56C 238.65416666666667 56 249.92916666666665 49.33333333333333 263.0833333333333 49.33333333333333C 276.2375 49.33333333333333 287.5125 56 300.6666666666667 56C 313.8208333333333 56 325.09583333333336 33.333333333333336 338.25 33.333333333333336C 351.40416666666664 33.333333333333336 362.6791666666667 40 375.8333333333333 40C 388.9875 40 400.2625 6.666666666666671 413.4166666666667 6.666666666666671C 426.5708333333333 6.666666666666671 437.84583333333336 80 451 80C 451 80 451 80 451 80M 451 80z" pathFrom="M -1 80L -1 80L 37.583333333333336 80L 75.16666666666667 80L 112.75 80L 150.33333333333334 80L 187.91666666666666 80L 225.5 80L 263.0833333333333 80L 300.6666666666667 80L 338.25 80L 375.8333333333333 80L 413.4166666666667 80L 451 80"></path><path id="SvgjsPath1226" d="M 0 80C 13.154166666666667 80 24.429166666666667 53.33333333333333 37.583333333333336 53.33333333333333C 50.737500000000004 53.33333333333333 62.0125 60 75.16666666666667 60C 88.32083333333334 60 99.59583333333333 26.666666666666664 112.75 26.666666666666664C 125.90416666666667 26.666666666666664 137.17916666666667 56 150.33333333333334 56C 163.4875 56 174.7625 53.33333333333333 187.91666666666666 53.33333333333333C 201.07083333333333 53.33333333333333 212.34583333333333 56 225.5 56C 238.65416666666667 56 249.92916666666665 49.33333333333333 263.0833333333333 49.33333333333333C 276.2375 49.33333333333333 287.5125 56 300.6666666666667 56C 313.8208333333333 56 325.09583333333336 33.333333333333336 338.25 33.333333333333336C 351.40416666666664 33.333333333333336 362.6791666666667 40 375.8333333333333 40C 388.9875 40 400.2625 6.666666666666671 413.4166666666667 6.666666666666671C 426.5708333333333 6.666666666666671 437.84583333333336 80 451 80" fill="none" fill-opacity="1" stroke="#884ffb" stroke-opacity="1" stroke-linecap="butt" stroke-width="4" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskonmldpq8g)" pathTo="M 0 80C 13.154166666666667 80 24.429166666666667 53.33333333333333 37.583333333333336 53.33333333333333C 50.737500000000004 53.33333333333333 62.0125 60 75.16666666666667 60C 88.32083333333334 60 99.59583333333333 26.666666666666664 112.75 26.666666666666664C 125.90416666666667 26.666666666666664 137.17916666666667 56 150.33333333333334 56C 163.4875 56 174.7625 53.33333333333333 187.91666666666666 53.33333333333333C 201.07083333333333 53.33333333333333 212.34583333333333 56 225.5 56C 238.65416666666667 56 249.92916666666665 49.33333333333333 263.0833333333333 49.33333333333333C 276.2375 49.33333333333333 287.5125 56 300.6666666666667 56C 313.8208333333333 56 325.09583333333336 33.333333333333336 338.25 33.333333333333336C 351.40416666666664 33.333333333333336 362.6791666666667 40 375.8333333333333 40C 388.9875 40 400.2625 6.666666666666671 413.4166666666667 6.666666666666671C 426.5708333333333 6.666666666666671 437.84583333333336 80 451 80" pathFrom="M -1 80L -1 80L 37.583333333333336 80L 75.16666666666667 80L 112.75 80L 150.33333333333334 80L 187.91666666666666 80L 225.5 80L 263.0833333333333 80L 300.6666666666667 80L 338.25 80L 375.8333333333333 80L 413.4166666666667 80L 451 80"></path><g id="SvgjsG1219" class="apexcharts-series-markers-wrap"><g class="apexcharts-series-markers"><circle id="SvgjsCircle1238" r="0" cx="413.4166666666667" cy="6.666666666666671" class="apexcharts-marker wadhi45oa no-pointer-events" stroke="#f65365" fill="#ffffff" fill-opacity="1" stroke-width="3" stroke-opacity="0.9" default-marker-size="0"></circle></g></g><g id="SvgjsG1220" class="apexcharts-datalabels"></g></g></g><line id="SvgjsLine1233" x1="0" y1="0" x2="451" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1234" x1="0" y1="0" x2="451" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1235" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG1236" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG1237" class="apexcharts-point-annotations"></g></g><rect id="SvgjsRect1212" width="0" height="0" x="0" y="0" rx="0" ry="0" fill="#fefefe" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect><g id="SvgjsG1229" class="apexcharts-yaxis" rel="0" transform="translate(-21, 0)"></g></svg></div></div></div>
<div class="monthly_plan_wraper">
<div class="single_plan d-flex align-items-center justify-content-between">
<div class="plan_left d-flex align-items-center">
 
<div>
<h5>Digital Magazine Hit</h5>
</div>
</div>
<span class="brouser_btn"><?=$statistic->visitor_chrome?></span>
</div>
<div class="single_plan d-flex align-items-center justify-content-between">
<div class="plan_left d-flex align-items-center">
 
<div>
<h5>Bids Posted This Year</h5>
</div>
</div>
<span class="brouser_btn"><?=$statistic->visitor_firefox?></span>
</div>
<div class="single_plan d-flex align-items-center justify-content-between">
<div class="plan_left d-flex align-items-center">
 
<div>
<h5>Contract Wins</h5>
</div>
</div>
<span class="brouser_btn"><?=$statistic->visitor_other?></span>
</div>
</div>

</div>
</div>

<div class="col-md-12" style="position:relative;">
	<img src="/assets/statistic/cap_sta.png?v=1" style="width:100%;"/>
	<div style="position:absolute; top:5px; right:10px; width:500px; text-align:center;">
		<h2 style="font-size:2.5em; font-weight:bold;color:#000;margin-bottom:0"><?=$total_cap.' '.$statistic->cap_sta?></h2>
		<h4  style="font-size:1.5em; font-weight:bold;"><?=$statistic->cap_sta_description?></h4>
	</div>
</div>

<div class="col-md-12 mt-3">
	<div class="white_card card_height_100 mb_30">	 
	<div class="row">
		<div class="col-md-7">
		<h3 class="m-0"><?=$total_bid.' '.$statistic->bid_title?></h3>
		<p><?=$statistic->bid_description?></p>
		<img src="/assets/statistic/tagcloud.jpg"/>
		
		</div>
		<div class="col-md-5">
		<img src="/assets/statistic/bids.jpg"/>			
		</div>
	</div>	
	</div>
</div>

<div class="col-md-12">
	<div class="white_card card_height_100 mb_30">
	<div class="white_card_header">
	<div class="box_header m-0">
	<div class="main-title">
	<h3 class="m-0"><?=$total_email.' '.$statistic->email_title?></h3>
	</div>
	</div>
	</div>
	<div><img src="/assets/statistic/open_email.png" style="width:100%"/></div>
	<div class="mb-3 text-center">
		<h3 style="font-size:1.8em;font-weight:bold"><?=$statistic->email_description?>
		<div style="text-align:right;padding:15px;float:right"><a class="btn btn-lg btn-primary text-white" style="display:inline-block;padding:5px 25px;" href="<?php echo base_url().$statistic->pdf?>">Download</a></div>
		</h3>
	</div>
	 
</div>
</div>

<div class="col-md-12">	 
	<div class="row">
		<div class="col-md-6"><img src="<?php echo base_url().$statistic->image1?>" style="max-width:100%"/></div>
		<div class="col-md-6"><img src="<?php echo base_url().$statistic->image2?>" style="max-width:100%"/></div>
		
	</div>
	<div class="row mt-3">
		<div class="col-md-6"><img src="<?php echo base_url().$statistic->image3?>" style="max-width:100%"/></div>
		<div class="col-md-6"><img src="<?php echo base_url().$statistic->image4?>" style="max-width:100%"/></div>
	 </div>
</div>
</div>


						 </div>
                    </div>

                    
                    <!-- /layout 1 -->
                   	
                    <p style="height: 30px;"></p>
                    <div class="mb-3 text-center">
							<h3> </h3>
                    </div>

                </div>
                <!-- /content area -->
            </div>
        </div>
    </div>
</div>
 