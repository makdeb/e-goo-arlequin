<div class="box create rounded">

	<a class="button good" href="<?php echo site_url(SITE_AREA .'/developer/news/create'); ?>">
		<?php echo lang('news_create_new_button'); ?>
	</a>

	<h3><?php echo lang('news_create_new'); ?></h3>

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
		
		<?php foreach ($records as $record) : ?>
			<tr>
				
				<td><?php echo $record->news_category?></td>
				<td><?php echo $record->news_title?></td>
				<td><?php echo $record->news_img_path?></td>
				<td><?php echo $record->news_text?></td>
				<td><?php echo anchor(SITE_AREA .'/developer/news/edit/'. $record->id, lang('news_edit'), '') ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>