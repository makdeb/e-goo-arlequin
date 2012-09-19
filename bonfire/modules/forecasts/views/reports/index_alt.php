
<div class="view split-view">
	
	<!-- forecasts List -->
	<div class="view">
	
	<?php if (isset($records) && is_array($records) && count($records)) : ?>
		<div class="scrollable">
			<div class="list-view" id="role-list">
				<?php foreach ($records as $record) : ?>
					<?php $record = (array)$record;?>
					<div class="list-item" data-id="<?php echo $record['id']; ?>">
						<p>
							<b><?php echo (empty($record['forecasts_name']) ? $record['id'] : $record['forecasts_name']); ?></b><br/>
							<span class="small"><?php echo (empty($record['forecasts_description']) ? lang('forecasts_edit_text') : $record['forecasts_description']);  ?></span>
						</p>
					</div>
				<?php endforeach; ?>
			</div>	<!-- /list-view -->
		</div>
	
	<?php else: ?>
	
	<div class="notification attention">
		<p><?php echo lang('forecasts_no_records'); ?> <?php echo anchor(SITE_AREA .'/reports/forecasts/create', lang('forecasts_create_new'), array("class" => "ajaxify")) ?></p>
	</div>
	
	<?php endif; ?>
	</div>
	<!-- forecasts Editor -->
	<div id="content" class="view">
		<div class="scrollable" id="ajax-content">
				
			<div class="box create rounded">
				<a class="button good ajaxify" href="<?php echo site_url(SITE_AREA .'/reports/forecasts/create')?>"><?php echo lang('forecasts_create_new_button');?></a>

				<h3><?php echo lang('forecasts_create_new');?></h3>

				<p><?php echo lang('forecasts_edit_text'); ?></p>
			</div>
			<br />
				<?php if (isset($records) && is_array($records) && count($records)) : ?>
				
					<h2>forecasts</h2>
	<table>
		<thead>
			<tr>
		<th>Event Date</th>
		<th>Event Name</th>
		<th>Event Category</th>
		<th>Event Description</th>
		<th>Event Coeff</th>
		<th>Event Result</th>
		<th>Forecast Result</th>
		<th>Is Vip</th>
		<th><?php echo lang('forecasts_actions'); ?></th>
		</tr>
		</thead>
		<tbody>
<?php
foreach ($records as $record) : ?>
			<tr>
				<td><?php echo $record->event_date?></td>
				<td><?php echo $record->event_name?></td>
				<td><?php echo $record->event_category?></td>
				<td><?php echo $record->event_description?></td>
				<td><?php echo $record->event_coeff?></td>
				<td><?php echo $record->event_result?></td>
				<td><?php echo $record->forecast_result?></td>
				<td><?php echo $record->is_vip?></td>
				<td><?php echo anchor(SITE_AREA .'/reports/forecasts/edit/'. $record->id, lang('forecasts_edit'), 'class="ajaxify"'); ?></td>
			</tr>
<?php endforeach; ?>
		</tbody>
	</table>
				<?php endif; ?>
				
		</div>	<!-- /ajax-content -->
	</div>	<!-- /content -->
</div>
