<div class="box create rounded">

	<a class="button good" href="<?php echo site_url(SITE_AREA .'/developer/forecasts/create'); ?>">
		<?php echo lang('forecasts_create_new_button'); ?>
	</a>

	<h3><?php echo lang('forecasts_create_new'); ?></h3>

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
		
		<?php foreach ($records as $record) : ?>
			<tr>
				
				<td><?php echo $record->event_date?></td>
				<td><?php echo $record->event_name?></td>
				<td><?php echo $record->event_category?></td>
				<td><?php echo $record->event_description?></td>
				<td><?php echo $record->event_coeff?></td>
				<td><?php echo $record->event_result?></td>
				<td><?php echo $record->forecast_result?></td>
				<td><?php echo $record->is_vip?></td>
				<td><?php echo anchor(SITE_AREA .'/developer/forecasts/edit/'. $record->id, lang('forecasts_edit'), '') ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>