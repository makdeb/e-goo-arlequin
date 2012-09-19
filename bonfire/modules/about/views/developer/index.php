
<div class="view split-view">
	
	<!-- About List -->
	<div class="view">
	
	<?php if (isset($records) && is_array($records) && count($records)) : ?>
		<div class="scrollable">
			<div class="list-view" id="role-list">
				<?php foreach ($records as $record) : ?>
					<?php $record = (array)$record;?>
					<div class="list-item" data-id="<?php echo $record['id']; ?>">
						<p>
							<b><?php echo (empty($record['about_name']) ? $record['id'] : $record['about_name']); ?></b><br/>
							<span class="small"><?php echo (empty($record['about_description']) ? lang('about_edit_text') : $record['about_description']);  ?></span>
						</p>
					</div>
				<?php endforeach; ?>
			</div>	<!-- /list-view -->
		</div>
	
	<?php else: ?>
	
	<div class="notification attention">
		<p><?php echo lang('about_no_records'); ?> <?php echo anchor(SITE_AREA .'/developer/about/create', lang('about_create_new'), array("class" => "ajaxify")) ?></p>
	</div>
	
	<?php endif; ?>
	</div>
	<!-- About Editor -->
	<div id="content" class="view">
		<div class="scrollable" id="ajax-content">
				
			<div class="box create rounded">
				<a class="button good ajaxify" href="<?php echo site_url(SITE_AREA .'/developer/about/create')?>"><?php echo lang('about_create_new_button');?></a>

				<h3><?php echo lang('about_create_new');?></h3>

				<p><?php echo lang('about_edit_text'); ?></p>
			</div>
			<br />
				<?php if (isset($records) && is_array($records) && count($records)) : ?>
				
					<h2>About</h2>
	<table>
		<thead>
			<tr>
		<th><?php echo lang('about_actions'); ?></th>
		</tr>
		</thead>
		<tbody>
<?php
foreach ($records as $record) : ?>
			<tr>
				<td><?php echo anchor(SITE_AREA .'/developer/about/edit/'. $record->id, lang('about_edit'), 'class="ajaxify"'); ?></td>
			</tr>
<?php endforeach; ?>
		</tbody>
	</table>
				<?php endif; ?>
				
		</div>	<!-- /ajax-content -->
	</div>	<!-- /content -->
</div>
