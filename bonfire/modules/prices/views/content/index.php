
<div class="view split-view">
	
	<!-- Prices List -->
	<div class="view">
	
	<?php if (isset($records) && is_array($records) && count($records)) : ?>
		<div class="scrollable">
			<div class="list-view" id="role-list">
				<?php foreach ($records as $record) : ?>
					<?php $record = (array)$record;?>
					<div class="list-item" data-id="<?php echo $record['id']; ?>">
						<p>
							Тариф<br/>
							<span class="small"><?php echo (empty($record['prices_name']) ? lang('prices_edit_text') : $record['prices_name']);  ?></span>
						</p>
					</div>
				<?php endforeach; ?>
			</div>	<!-- /list-view -->
		</div>
	
	<?php else: ?>
	
	<div class="notification attention">
		<p><?php echo lang('prices_no_records'); ?> <?php echo anchor(SITE_AREA .'/content/prices/create', lang('prices_create_new'), array("class" => "ajaxify")) ?></p>
	</div>
	
	<?php endif; ?>
	</div>
	<!-- Prices Editor -->
	<div id="content" class="view">
		<div class="scrollable" id="ajax-content">
				
			<!--<div class="box create rounded">
				<a class="button good ajaxify" href="<?php echo site_url(SITE_AREA .'/content/prices/create')?>"><?php echo lang('prices_create_new_button');?></a>

				<h3><?php echo lang('prices_create_new');?></h3>

				<p><?php echo lang('prices_edit_text'); ?></p>
			</div>-->
			<br />
				<?php if (isset($records) && is_array($records) && count($records)) : ?>
				
					<h2>Цены</h2>
	<table>
		<thead>
			<tr>
		<th>Тариф</th>
		<th>Гривны</th>
		<th>Рубли</th>
		<th>Доллары</th>
		<th><?php echo lang('prices_actions'); ?></th>
		</tr>
		</thead>
		<tbody>
<?php
foreach ($records as $record) : ?>
			<tr>
				<td><?php echo $record->prices_name?></td>
				<td><?php echo $record->prices_uah?> гривен</td>
				<td><?php echo $record->prices_rur?> рублей</td>
				<td><?php echo $record->prices_usd?> долларов</td>
				<td><?php echo anchor(SITE_AREA .'/content/prices/edit/'. $record->id, lang('prices_edit'), 'class="ajaxify"'); ?></td>
			</tr>
<?php endforeach; ?>
		</tbody>
	</table>
				<?php endif; ?>
				
		</div>	<!-- /ajax-content -->
	</div>	<!-- /content -->
</div>
