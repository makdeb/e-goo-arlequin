<div class="box create rounded">

	<a class="button good" href="<?php echo site_url(SITE_AREA .'/content/forecasts/create'); ?>">
		<?php echo lang('forecasts_create_new_button'); ?>
	</a>

	<h3><?php echo lang('forecasts_create_new'); ?></h3>

	<p><?php echo lang('forecasts_edit_text'); ?></p>

</div>

<br />

<?php if (isset($records) && is_array($records) && count($records)) : ?>
				
	<h2>Прогнозы</h2>
	<table>
		<thead>
			<tr>
			
		<th>Дата события</th>
		<th>Название</th>
		<th>Категория</th>
		<th>Описание</th>
		<th>Коэффициент</th>
		<th>Прогнозируемый результат</th>
		<th>Сбылся ли прогноз</th>
		<th>Vip прогноз</th>
		
			<th><?php echo lang('forecasts_actions'); ?></th>
			</tr>
		</thead>
		<tbody>
		
		<?php foreach ($records as $record) : ?>
			<tr>
				
				<td><?php echo date("d.m.Y H:i:s",strtotime($record->event_date))?></td>
				<td><?php echo $record->event_name?></td>
				<td><?php echo $ecdata[$record->event_category]?></td>
                	<?php $event_description_stripped=strip_tags($record->event_description); ?>
				<td><?php echo strlen($event_description_stripped)>40 ? substr($event_description_stripped,0,40).'...' : $event_description_stripped;?></td>
				<td><?php echo $record->event_coeff?></td>
				<td><?php echo $record->event_result?></td>
				<td><?php 
                                        switch ((int)$record->forecast_result) {
                                            case 0:
                                                echo("Результат неизвестен");
                                                break;
                                            case 1:
                                                echo("Прогноз сбылся");
                                                break;
                                            case 2:
                                                echo("Прогноз не сбылся");
                                                break;                                            
                                        }
                                ?></td>
				<td><?php echo ((int)$record->is_vip==1) ? "Да" : "Нет";?></td>
				<td><?php echo anchor(SITE_AREA .'/content/forecasts/edit/'. $record->id, lang('forecasts_edit'), '') ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>