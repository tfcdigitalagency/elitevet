<style type="text/css">
	.table-bordered > thead {
		background-color: #51a79b;
		color: white;
	}

	.action a {
		cursor: pointer;
	}
</style>
<!-- Page header -->
<div class="page-header page-header-light">
	<div class="page-header-content header-elements-md-inline">
		<div class="page-title d-flex">
			<h4><span class="font-weight-semibold">Statistic</span></h4>

		</div>
	</div>
</div>
<!-- /page header -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<!-- Content area -->
<div class="content">

	<!-- Basic modals -->
	<div class="card">
		<div class="card-body">
			<h2><?php echo $article['article_title'] ?></h2>

			<div class="float-right" style="position: relative; right: 0; top: -30px; width: 100px;"><a
						class="btn btn-primary" target="_blank"
						href="<?php echo site_url('news/article/' . $article['slug']) ?>">View Article</a></div>
			<div>
				<?php echo $article['short'] ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-5">
			<div class="card">
				<div class="card-body">
					<h3>Delivery Statistic</h3>
					<?php
					$sent = article_get_log($article['id'], 'sent');
					$opened = article_get_log($article['id'], 'opened');
					$clicked = article_get_log($article['id'], 'clicked');
					$viewed = article_get_log($article['id'], 'viewed');
					$unknow = $sent - $opened;
					?>
					<div class="row">
						<div class="col-4">
							<table width="100%">
								<tr>
									<th>Sent</th>
									<td class="text-right"><?php echo $sent; ?></td>
								</tr>
								<tr>
									<th>Opened</th>
									<td class="text-right"><?php echo $opened; ?></td>
								</tr>
								<tr>
									<th>Clicked</th>
									<td class="text-right"><?php echo $clicked; ?></td>
								</tr>
								<tr>
									<th>Viewed</th>
									<td class="text-right"><?php echo $viewed; ?></td>
								</tr>
							</table>
						</div>
						<div class="col-12">
							<div id="piechart" style="width: 100%; height: 400px;"></div>
							<script type="text/javascript">
								google.charts.load('current', {'packages': ['corechart']});
								google.charts.setOnLoadCallback(drawChart);

								function drawChart() {

									var data = google.visualization.arrayToDataTable([
										['Action', 'value'],
										['Opened',     <?php echo $clicked?>],
										['Clicked',     <?php echo $opened?>],
										['No-action',  <?php echo $unknow?>]
									]);

									var options = {
										title: ''
									};

									var chart = new google.visualization.PieChart(document.getElementById('piechart'));

									chart.draw(data, options);
								}
							</script>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-7">
			<div class="card">
				<div class="card-body">
					<h3>Recent Logs</h3>
					<table width="100%" border="1" cellpadding="3" cellspacing="0" style="border-collapse: collapse; border-color:#f1f1f1; ">
						<tr style="background: lightyellow">
							<th>Id</th>
							<th>Action</th>
							<th>Who are they</th>
							<th>Type</th>
							<th>IP</th>
							<th>Time</th>
							<th>Referer</th>
						</tr>
						<tbody>
						<?php foreach ($recents as $item):?>
						<tr>
							<td><?php echo $item['id']?></td>
							<td><?php echo $item['action']?></td>
							<td><?php echo ($item['email'])?'<b>'.$item['name'].'</b><br>('.$item['email'].')' :''; ?></td>
							<td><?php echo $item['title']?></td>
							<td><?php echo $item['ip']?></td>
							<td><?php echo $item['created']?></td>
							<td><?php echo $item['referer']?></td>
						</tr>
						<?php endforeach;?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="card-body">
			<h3>Last 30 days</h3>
			<div>
				<div id="chart_div"></div>
				<script>
					google.charts.load('current', {packages: ['corechart', 'line']});
					google.charts.setOnLoadCallback(drawBasic);

					function drawBasic() {

						var data = new google.visualization.DataTable();
						data.addColumn('string', 'X');
						data.addColumn('number', 'Opened');
						data.addColumn('number', 'Clicked');
						data.addColumn('number', 'Viewed');

						data.addRows([
							<?php
							foreach ($statistic as $item) {
								echo '["' . $item[0] . '",' . $item[1] . ',' . $item[2] . ',' . $item[3] . '],';
							}
							?>
						]);

						var options = {
							hAxis: {
								title: 'Date'
							},
							vAxis: {
								title: 'Popularity'
							},
							height: 500
						};

						var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

						chart.draw(data, options);
					}
				</script>
			</div>
		</div>
	</div>

	<!-- /basic modals -->

</div>
<!-- /content area -->


<script>


</script>
