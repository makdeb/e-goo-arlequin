
<div class="view split-view">
	
	<!-- keys List -->
	<div class="view">
	
	<?php if (isset($records) && is_array($records) && count($records)) : ?>
		<div class="scrollable">
			<div class="list-view" id="role-list">
				<?php foreach ($records as $record) : ?>
					<?php $record = (array)$record;?>
					<div class="list-item" data-id="<?php echo $record['id']; ?>">
						<p>
							<b><?php echo (empty($record['keys_name']) ? $record['id'] : $record['keys_name']); ?></b><br/>
							<span class="small"><?php echo (empty($record['keys_description']) ? lang('keys_edit_text') : $record['keys_description']);  ?></span>
						</p>
					</div>
				<?php endforeach; ?>
			</div>	<!-- /list-view -->
		</div>
	
	<?php else: ?>
	
	<div class="notification attention">
		<p><?php echo lang('keys_no_records'); ?> <?php echo anchor(SITE_AREA .'/content/keys/create', lang('keys_create_new'), array("class" => "ajaxify")) ?></p>
	</div>
	
	<?php endif; ?>
	</div>
	<!-- keys Editor -->
	<div id="content" class="view">
		<div class="scrollable" id="ajax-content">
				
			<div class="box create rounded">
				<a class="button good ajaxify" href="<?php echo site_url(SITE_AREA .'/content/keys/create')?>"><?php echo lang('keys_create_new_button');?></a>

				<h3><?php echo lang('keys_create_new');?></h3>

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
<?php
foreach ($records as $record) : ?>
			<tr>
				<td><?php echo $record->key?></td>
				<td><?php echo $record->key_owner?></td>
				<td><?php echo $record->valid_untill?></td>
				<td><?php echo $record->bought_on?></td>
				<td><?php echo $record->payment_details?></td>
				<td><?php echo $record->is_paid?></td>
				<td><?php echo anchor(SITE_AREA .'/content/keys/edit/'. $record->id, lang('keys_edit'), 'class="ajaxify"'); ?></td>
			</tr>
<?php endforeach; ?>
		</tbody>
	</table>
				<?php endif; ?>
				
		</div>	<!-- /ajax-content -->
	</div>	<!-- /content -->
</div>
