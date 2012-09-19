<div class="box create rounded">

	<a class="button good" href="<?php echo site_url(SITE_AREA .'/developer/eventscategories/create'); ?>">
		<?php echo lang('eventscategories_create_new_button'); ?>
	</a>

	<h3><?php echo lang('eventscategories_create_new'); ?></h3>

	<p><?php echo lang('eventscategories_edit_text'); ?></p>

</div>

<br />

<?php if (isset($records) && is_array($records) && count($records)) : ?>
				
	<h2>eventscategories</h2>
	<table>
		<thead>
			<tr>
			
		<th>Event Category Name</th>
		<th>Event Category Img</th>
		
			<th><?php echo lang('eventscategories_actions'); ?></th>
			</tr>
		</thead>
		<tbody>
		
		<?php foreach ($records as $record) : ?>
			<tr>
				
				<td><?php echo $record->event_category_name?></td>
				<td><?php echo $record->event_category_img?></td>
				<td><?php echo anchor(SITE_AREA .'/developer/eventscategories/edit/'. $record->id, lang('eventscategories_edit'), '') ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>