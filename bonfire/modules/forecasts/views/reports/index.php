<?php if (validation_errors()) : ?>
<div class="notification error">
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>

<div class="box create rounded" style="width: 50%; float: left;">

	<a class="button good" href="<?php echo site_url(SITE_AREA .'/reports/forecasts/create'); ?>">
		<?php echo lang('forecasts_create_new_button'); ?>
	</a>

	<h3><?php echo lang('forecasts_create_new'); ?></h3>

</div>

<?php echo form_open($this->uri->uri_string(), 'class="constrained ajax-form"'); ?>
<div class="box create rounded mail">
	<h3><?php echo lang('forecasts_send_mail'); ?></h3>
	<input id="limit_newsletter" type="text" name="limit_newsletter" value="<?php echo set_value('limit_newsletter'); ?>"  />
	<input id="newsletter" type="submit" name="newsletter" value="Разослать" />
	<p><?php echo lang('forecasts_mail_text'); ?></p>

</div>
<?php echo form_close(); ?>

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
				<td><?php echo anchor(SITE_AREA .'/reports/forecasts/edit/'. $record->id, lang('forecasts_edit'), '') ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>