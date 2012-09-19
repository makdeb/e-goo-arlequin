<div class="box create rounded">

	<a class="button good" href="<?php echo site_url(SITE_AREA .'/content/prices/create'); ?>">
		<?php echo lang('prices_create_new_button'); ?>
	</a>

	<h3><?php echo lang('prices_create_new'); ?></h3>

	<p><?php echo lang('prices_edit_text'); ?></p>

</div>

<br />

<?php if (isset($records) && is_array($records) && count($records)) : ?>
				
	<h2>Prices</h2>
	<table>
		<thead>
			<tr>
			
		<th>Tarif</th>
		<th>Hrivna</th>
		<th>Rubl</th>
		<th>Dollar</th>
		
			<th><?php echo lang('prices_actions'); ?></th>
			</tr>
		</thead>
		<tbody>
		
		<?php foreach ($records as $record) : ?>
			<tr>
				
				<td><?php echo $record->prices_name?></td>
				<td><?php echo $record->prices_uah?></td>
				<td><?php echo $record->prices_rur?></td>
				<td><?php echo $record->prices_usd?></td>
				<td><?php echo anchor(SITE_AREA .'/content/prices/edit/'. $record->id, lang('prices_edit'), '') ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>