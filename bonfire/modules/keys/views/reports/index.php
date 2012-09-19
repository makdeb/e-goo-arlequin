<div class="box create rounded">

	<a class="button good" href="<?php echo site_url(SITE_AREA .'/reports/keys/create'); ?>">
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
                <th>Key price</th>
		<th>Valid Untill</th>
                <th>Заказан</th>
		<th>Bought On</th>
		<th>Payment Details</th>
                <th>Paid</th>
		
			<th><?php echo lang('keys_actions'); ?></th>
			</tr>
		</thead>
		<tbody>
		
		<?php foreach ($records as $record) : ?>
			<tr>
				
				<td><?php echo $record->key?></td>
				<td><?php echo $record->last_name.' '.$record->first_name?></td>
                                <td><?php echo $record->key_price!=null ? $record->key_price : 'не определено';?></td>
				<td><?php echo $record->valid_untill!=null ? date('d.m.Y H:i:s',strtotime($record->valid_untill)) : 'не определено';?></td>                                
                                <td><?php echo date('d.m.Y H:i:s',strtotime($record->ordered_on));?></td>
                                <td><?php echo $record->bought_on!=null ? date('d.m.Y H:i:s',strtotime($record->bought_on)) : 'не определено';?></td>
				<td><?php echo strlen($record->payment_details)>40 ? substr($record->payment_details,0,40).'...' : $record->payment_details;?></td>
                                <td><?php echo $record->is_paid==1 ? 'Оплачен' : 'Не оплачен';?></td>
				<td><?php echo anchor(SITE_AREA .'/reports/keys/edit/'. $record->id, lang('keys_edit'), '') ?></td>                                
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>