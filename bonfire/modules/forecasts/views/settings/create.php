<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4>A PHP Error was encountered</h4>

<p>Severity: Notice</p>
<p>Message:  Undefined offset: 1</p>
<p>Filename: files/view_default.php</p>
<p>Line Number: 190</p>

</div>
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
        <?php echo form_label('Event Date', 'event_date'); ?>
			<script>head.ready(function(){$('#event_date').datetimepicker({ dateFormat: 'yy-mm-dd', timeFormat: 'hh:mm:ss'});});</script>
        <input id="event_date" type="text" name="event_date" maxlength="20" value="<?php echo set_value('event_date', isset($forecasts['event_date']) ? $forecasts['event_date'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Event Name', 'event_name'); ?>
        <input id="event_name" type="text" name="event_name" maxlength="50" value="<?php echo set_value('event_name', isset($forecasts['event_name']) ? $forecasts['event_name'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Event Category', 'event_category'); ?>

        <?php // Change the values in this array to populate your dropdown as required ?>
        
<?php $options = array(
				11 => 11,
); ?>

        <?php echo form_dropdown('event_category', $options, set_value('event_category', isset($forecasts['event_category']) ? $forecasts['event_category'] : ''))?>
</div>                                             
                        
<div>
        <?php echo form_label('Event Description', 'event_description'); ?>
	<?php echo form_textarea( array( 'name' => 'event_description', 'id' => 'event_description', 'rows' => '5', 'cols' => '80', 'value' => set_value('event_description', isset($forecasts['event_description']) ? $forecasts['event_description'] : '') ) )?>
</div>
<div>
        <?php echo form_label('Event Coeff', 'event_coeff'); ?>
        <input id="event_coeff" type="text" name="event_coeff" maxlength="1" value="<?php echo set_value('event_coeff', isset($forecasts['event_coeff']) ? $forecasts['event_coeff'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Event Result', 'event_result'); ?>
        <input id="event_result" type="text" name="event_result" maxlength="10" value="<?php echo set_value('event_result', isset($forecasts['event_result']) ? $forecasts['event_result'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Forecast Result', 'forecast_result'); ?>
        <input id="forecast_result" type="text" name="forecast_result" maxlength="6" value="<?php echo set_value('forecast_result', isset($forecasts['forecast_result']) ? $forecasts['forecast_result'] : ''); ?>"  />
</div>

<div>
	
        <?php // Change the values/css classes to suit your needs ?>
	    <?php echo form_label('Is Vip', 'is_vip'); ?>               
        <input type="checkbox" id="is_vip" name="is_vip" value="1" <?php echo (isset($forecasts['is_vip']) && $forecasts['is_vip'] == 1) ? 'checked="checked"' : set_checkbox('is_vip', 1); ?>> 
	
</div> 


	<div class="text-right">
		<br/>
		<input type="submit" name="submit" value="Create forecasts" /> or <?php echo anchor(SITE_AREA .'/settings/forecasts', lang('forecasts_cancel')); ?>
	</div>
	<?php echo form_close(); ?>
