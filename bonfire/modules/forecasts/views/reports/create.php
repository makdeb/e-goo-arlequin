<?php if (validation_errors()) : ?>
<div class="notification error">
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs    
if( isset($forecasts) ) {
	$forecasts = (array)$forecasts;
}
$id = isset($forecasts['id']) ? "/".$forecasts['id'] : '';
?>
<?php echo form_open($this->uri->uri_string(), 'class="constrained ajax-form"'); ?>
<?php if(isset($forecasts['id'])): ?><input id="id" type="hidden" name="id" value="<?php echo $forecasts['id'];?>"  /><?php endif;?>
<div>
        <?php echo form_label('Дата события', 'event_date'); ?>
			<script>head.ready(function(){$('#event_date').datetimepicker({ dateFormat: 'dd.mm.yy', timeFormat: 'hh:mm:ss'});});</script>
        <input id="event_date" type="text" name="event_date" maxlength="20" value="<?php echo set_value('event_date', isset($forecasts['event_date']) ? $forecasts['event_date'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Название', 'event_name'); ?>
        <input id="event_name" type="text" name="event_name" maxlength="50" value="<?php echo set_value('event_name', isset($forecasts['event_name']) ? $forecasts['event_name'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Категория', 'event_category'); ?>
        <?php echo form_dropdown('event_category', $ecdata, set_value('event_category', isset($forecasts['event_category']) ? $forecasts['event_category'] : ''))?>
</div>                                             
                        
<div>
        <?php echo form_label('Описание', 'event_description'); ?>
	<?php echo form_textarea( array( 'name' => 'event_description', 'id' => 'event_description', 'rows' => '5', 'cols' => '80', 'value' => set_value('event_description', isset($forecasts['event_description']) ? $forecasts['event_description'] : '') ) )?>
</div>
<div>
        <?php echo form_label('Коэффициент', 'event_coeff'); ?>
        <input id="event_coeff" type="text" name="event_coeff" maxlength="5" value="<?php echo set_value('event_coeff', isset($forecasts['event_coeff']) ? $forecasts['event_coeff'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Прогнозируемый результат', 'event_result'); ?>
        <input id="event_result" type="text" name="event_result" maxlength="10" value="<?php echo set_value('event_result', isset($forecasts['event_result']) ? $forecasts['event_result'] : ''); ?>"  />
</div>

<div>
	
	<?php echo form_label('Vip прогноз', 'is_vip'); ?>               
        <input type="checkbox" id="is_vip" name="is_vip" value="1" <?php echo (isset($forecasts['is_vip']) && $forecasts['is_vip'] == 1) ? 'checked="checked"' : set_checkbox('is_vip', 1); ?>> 
	
</div> 

<div>
	
	<?php echo form_label('Сбылся ли прогноз', 'forecast_result'); ?>               
	<?php echo form_dropdown('forecast_result', $frdata, set_value('forecast_result', isset($forecasts['forecast_result']) ? $forecasts['forecast_result'] : ''))?>
	
</div> 


	<div class="text-right">
		<br/>
		<input type="submit" name="submit" value="Создать прогноз" /> или <?php echo anchor(SITE_AREA .'/reports/forecasts', lang('forecasts_cancel')); ?>
	</div>
	<?php echo form_close(); ?>
