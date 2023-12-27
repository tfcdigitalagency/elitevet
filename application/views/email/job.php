<table class="gv-table-view-content" style="border-collapse: collapse;" border="1" width="100%">
	<tbody>
	<tr id="gv-field-5-1" class="gv-field-5-1">
		<th scope="row" width="30%"><span class="gv-field-label">Company</span></th>
		<td><?php echo $data['company']?></td></tr>
	<tr id="gv-field-5-2" class="gv-field-5-2">
		<th scope="row"><span class="gv-field-label">Name</span></th>
		<td><?php echo $data['name']?></td></tr>
	<tr id="gv-field-5-4" class="gv-field-5-4">
		<th scope="row"><span class="gv-field-label">Email</span></th>
		<td><a href="mailto:<?php echo $data['email']?>"><?php echo $data['email']?></a></td></tr>
	<tr id="gv-field-5-5" class="gv-field-5-5">
		<th scope="row"><span class="gv-field-label">Phone</span></th>
		<td><a href="tel:<?php echo $data['phone']?>"><?php echo $data['phone']?></a></td></tr>
	<tr id="gv-field-5-8" class="gv-field-5-8">
		<th scope="row">
			<span class="gv-field-label">Deadline Date</span></th><td><?php echo ($data['end_date'])?date("m/d/Y",strtotime($data['end_date'])):''; ?></td></tr>
	<tr id="gv-field-5-11" class="gv-field-5-11">
		<th scope="row"><span class="gv-field-label">Opportunity Title</span></th>
		<td><?php echo $data['title']?></td></tr>
	<tr id="gv-field-5-12" class="gv-field-5-12"><th scope="row">
			<span class="gv-field-label">Description</span></th>
		<td><p><?php echo $data['details']?></p>
		</td></tr>
	<tr id="gv-field-5-14" class="gv-field-5-14">
		<th scope="row"><span class="gv-field-label">Post Start Date</span></th>
		<td><?php echo ($data['start_date'])?date("m/d/Y",strtotime($data['start_date'])):''; ?></td></tr>
	<tr id="gv-field-5-15" class="gv-field-5-15">
		<th scope="row"><span class="gv-field-label">Post End Date</span></th>
		<td><?php echo ($data['end_date'])?date("m/d/Y",strtotime($data['end_date'])):''; ?></td></tr>
	<?php if($data['second_thumbnail']):?>
	<tr id="gv-field-5-10" class="gv-field-5-10">
		<th scope="row"><span class="gv-field-label">Include attachment (PDF/JPG)</span></th>
		<td><a href="<?php echo  base_url().$data['second_thumbnail']?>" rel="noopener noreferrer" target="_blank">
				<?php
				$filename = end(explode('/',$data['second_thumbnail']));
				echo $filename?>
			</a></td>
	</tr>
	<?php if($data['documents']){ ?>
		<tr id="gv-field-5-2" class="gv-field-5-2">
			<th scope="row"><span class="gv-field-label">Documents</span></th>
			<td>
			<ul style="padding:0;margin:0">
			<?php $commodity = json_decode($data['documents'],true);
			foreach($commodity as $c){
				?><li><a href="<?php echo trim($c['path']);?>"><?php echo($c['fileName']);?></a></li><?php
			}
			?>
			</ul>
			</td></tr>												
		<?php }?>
	<?php endif;?>
	</tbody>

</table>

<div style="margin-top:10px; text-align:center;"><a style="display:inline-block;padding:3px 15px; text-align:center; background:#185EAC; color:#fff; border-radius:10px;" href="<?php echo site_url('/customer/opportunities/detail/'.$data['id']);?>">View Detail</a></div>