<div class="box create rounded">

	<a class="button good" href="<?php echo site_url(SITE_AREA .'/settings/keys/create'); ?>">
		<?php echo lang('keys_create_new_button'); ?>
	</a>

	<h3><?php echo lang('keys_create_new'); ?></h3>

	<p><?php echo lang('keys_edit_text'); ?></p>

</div>

<br />

<?php if (isset($records) && is_array($records) && count($records)) : ?>
				
	<h2>keys</h2>
	<table>
		<thead>
			<tr>
			
		<th>Key</th>
		<th>Key Owner</th>
		<th>Valid Untill</th>
		<th>Bought On</th>
		<th>Payment Details</th>
		<th>Is Paid</th>
		
			<th><?php echo lang('keys_actions'); ?></th>
			</tr>
		</thead>
		<tbody>
		
		<?php foreach ($records as $record) : ?>
			<tr>
				
				<td><?php echo $record->key?></td>
				<td><?php echo $record->key_owner?></td>
				<td><?php echo $record->valid_untill?></td>
				<td><?php echo $record->bought_on?></td>
				<td><?php echo $record->payment_details?></td>
				<td><?php echo $record->is_paid?></td>
				<td><?php echo anchor(SITE_AREA .'/settings/keys/edit/'. $record->id, lang('keys_edit'), '') ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>