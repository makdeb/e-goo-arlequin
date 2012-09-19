
<div class="view split-view">
	
	<!-- eventscategories List -->
	<div class="view">
	
	<?php if (isset($records) && is_array($records) && count($records)) : ?>
		<div class="scrollable">
			<div class="list-view" id="role-list">
				<?php foreach ($records as $record) : ?>
					<?php $record = (array)$record;?>
					<div class="list-item" data-id="<?php echo $record['id']; ?>">
						<p>
							<b><?php echo (empty($record['eventscategories_name']) ? $record['id'] : $record['eventscategories_name']); ?></b><br/>
							<span class="small"><?php echo (empty($record['eventscategories_description']) ? lang('eventscategories_edit_text') : $record['eventscategories_description']);  ?></span>
						</p>
					</div>
				<?php endforeach; ?>
			</div>	<!-- /list-view -->
		</div>
	
	<?php else: ?>
	
	<div class="notification attention">
		<p><?php echo lang('eventscategories_no_records'); ?> <?php echo anchor(SITE_AREA .'/reports/eventscategories/create', lang('eventscategories_create_new'), array("class" => "ajaxify")) ?></p>
	</div>
	
	<?php endif; ?>
	</div>
	<!-- eventscategories Editor -->
	<div id="content" class="view">
		<div class="scrollable" id="ajax-content">
				
			<div class="box create rounded">
				<a class="button good ajaxify" href="<?php echo site_url(SITE_AREA .'/reports/eventscategories/create')?>"><?php echo lang('eventscategories_create_new_button');?></a>

				<h3><?php echo lang('eventscategories_create_new');?></h3>

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
<?php
foreach ($records as $record) : ?>
			<tr>
				<td><?php echo $record->event_category_name?></td>
				<td><?php echo $record->event_category_img?></td>
				<td><?php echo anchor(SITE_AREA .'/reports/eventscategories/edit/'. $record->id, lang('eventscategories_edit'), 'class="ajaxify"'); ?></td>
			</tr>
<?php endforeach; ?>
		</tbody>
	</table>
				<?php endif; ?>
				
		</div>	<!-- /ajax-content -->
	</div>	<!-- /content -->
</div>
