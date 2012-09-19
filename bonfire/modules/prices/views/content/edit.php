
<?php if (validation_errors()) : ?>
<div class="notification error">
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs    
if( isset($prices) ) {
	$prices = (array)$prices;
}
$id = isset($prices['id']) ? "/".$prices['id'] : '';
?>
<?php echo form_open($this->uri->uri_string(), 'class="constrained ajax-form"'); ?>
<div style="display: none">
        <?php echo form_label('Tarif', 'prices_name'); ?> <span class="required">*</span>

        <?php // Change the values in this array to populate your dropdown as required ?>
        
<?php $options = array(
				'матч' => '1 матч',
				'1 день' => '1 день',
				'7 дней' => '7 дней',
				'15 дней' => '15 дней',
				'30 дней' => '30 дней'
); ?>

        <?php echo form_dropdown('prices_name', $options, set_value('prices_name', isset($prices['prices_name']) ? $prices['prices_name'] : ''))?>
</div>                                             

 <div style="text-align: center;"><b>Тариф &laquo;<?php echo isset($prices['prices_name']) ? $prices['prices_name'] : '' ;?>&raquo;</b></div>
                        
<div>
        <?php echo form_label('Гривна', 'prices_uah'); ?> <span class="required">*</span>
        <input id="prices_uah" type="text" name="prices_uah" maxlength="6,2" value="<?php echo set_value('prices_uah', isset($prices['prices_uah']) ? $prices['prices_uah'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Рубль', 'prices_rur'); ?> <span class="required">*</span>
        <input id="prices_rur" type="text" name="prices_rur" maxlength="6,2" value="<?php echo set_value('prices_rur', isset($prices['prices_rur']) ? $prices['prices_rur'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Доллар', 'prices_usd'); ?> <span class="required">*</span>
        <input id="prices_usd" type="text" name="prices_usd" maxlength="6,2" value="<?php echo set_value('prices_usd', isset($prices['prices_usd']) ? $prices['prices_usd'] : ''); ?>"  />
</div>



	<div class="text-right">
		<br/>
		<input type="submit" name="submit" value="Править Тариф" /> or <?php echo anchor(SITE_AREA .'/content/prices', lang('prices_cancel')); ?>
	</div>
	<?php echo form_close(); ?>

	<!--<div class="box delete rounded">
		<a class="button" id="delete-me" href="<?php echo site_url(SITE_AREA .'/content/prices/delete/'. $id); ?>" onclick="return confirm('<?php echo lang('prices_delete_confirm'); ?>')"><?php echo lang('prices_delete_record'); ?></a>
		
		<h3><?php echo lang('prices_delete_record'); ?></h3>
		
		<p><?php echo lang('prices_edit_text'); ?></p>
	</div>-->
