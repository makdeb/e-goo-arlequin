
<div class="view split-view">
	
	<!-- news List -->
	<div class="view">
	
	<?php if (isset($records) && is_array($records) && count($records)) : ?>
		<div class="scrollable">
			<div class="list-view" id="role-list">
				<?php foreach ($records as $record) : ?>
					<?php $record = (array)$record;?>
					<div class="list-item" data-id="<?php echo $record['id']; ?>">
						<p>
							<b><?php echo (empty($record['news_name']) ? $record['id'] : $record['news_name']); ?></b><br/>
							<span class="small"><?php echo (empty($record['news_description']) ? lang('news_edit_text') : $record['news_description']);  ?></span>
						</p>
					</div>
				<?php endforeach; ?>
			</div>	<!-- /list-view -->
		</div>
	
	<?php else: ?>
	
	<div class="notification attention">
		<p><?php echo lang('news_no_records'); ?> <?php echo anchor(SITE_AREA .'/settings/news/create', lang('news_create_new'), array("class" => "ajaxify")) ?></p>
	</div>
	
	<?php endif; ?>
	</div>
	<!-- news Editor -->
	<div id="content" class="view">
		<div class="scrollable" id="ajax-content">
				
			<div class="box create rounded">
				<a class="button good ajaxify" href="<?php echo site_url(SITE_AREA .'/settings/news/create')?>"><?php echo lang('news_create_new_button');?></a>

				<h3><?php echo lang('news_create_new');?></h3>

				<p><?php echo lang('news_edit_text'); ?></p>
			</div>
			<br />
				<?php if (isset($records) && is_array($records) && count($records)) : ?>
				
					<h2>news</h2>
	<table>
		<thead>
			<tr>
		<th>Category</th>
		<th>Title</th>
		<th>Path to img</th>
		<th>Text</th>
		<th><?php echo lang('news_actions'); ?></th>
		</tr>
		</thead>
		<tbody>
<?php
foreach ($records as $record) : ?>
			<tr>
				<td><?php echo $record->news_category?></td>
				<td><?php echo $record->news_title?></td>
				<td><?php echo $record->news_img_path?></td>
				<td><?php echo $record->news_text?></td>
				<td><?php echo anchor(SITE_AREA .'/settings/news/edit/'. $record->id, lang('news_edit'), 'class="ajaxify"'); ?></td>
			</tr>
<?php endforeach; ?>
		</tbody>
	</table>
				<?php endif; ?>
				
		</div>	<!-- /ajax-content -->
	</div>	<!-- /content -->
</div>
