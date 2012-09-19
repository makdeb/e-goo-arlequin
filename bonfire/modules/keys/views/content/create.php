
<?php if (validation_errors()) : ?>
<div class="notification error">
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs    
if( isset($keys) ) {
	$keys = (array)$keys;
}
$id = isset($keys['id']) ? "/".$keys['id'] : '';
?>
<?php echo form_open($this->uri->uri_string(), 'class="constrained ajax-form"'); ?>
<?php if(isset($keys['id'])): ?><input id="id" type="hidden" name="id" value="<?php echo $keys['id'];?>"  /><?php endif;?>
<div>
        <?php echo form_label('Ключ', 'key'); ?>
        <input id="key" type="text" name="key" maxlength="32" value="<?php echo set_value('key', isset($keys['key']) ? $keys['key'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Владелец', 'key_owner'); ?>
        <?php echo form_dropdown('key_owner', $userdata, set_value('key_owner', isset($keys['key_owner']) ? $keys['key_owner'] : ''))?>
</div>

<div>
        <?php echo form_label('Цена ключа', 'key_price'); ?>
        <input id="key_price" type="text" name="key_price" maxlength="12" value="<?php echo set_value('key_price', isset($keys['key_price']) ? $keys['key_price'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Действителен до', 'valid_untill'); ?>
			<script>head.ready(function(){$('#valid_untill').datetimepicker({ dateFormat: 'dd.mm.yy', timeFormat: 'hh:mm:ss'});});</script>
        <input id="valid_untill" type="text" name="valid_untill" maxlength="20" value="<?php echo set_value('valid_untill', isset($keys['valid_untill']) ? $keys['valid_untill'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Заказан', 'ordered_on'); ?>
			<script>head.ready(function(){$('#ordered_on').datetimepicker({ dateFormat: 'dd.mm.yy', timeFormat: 'hh:mm:ss'});});</script>
        <input id="ordered_on" type="text" name="ordered_on" maxlength="20" value="<?php echo set_value('ordered_on', isset($keys['ordered_on']) ? $keys['ordered_on'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Куплен', 'bought_on'); ?>
			<script>head.ready(function(){$('#bought_on').datetimepicker({ dateFormat: 'dd.mm.yy', timeFormat: 'hh:mm:ss'});});</script>
        <input id="bought_on" type="text" name="bought_on" maxlength="20" value="<?php echo set_value('bought_on', isset($keys['bought_on']) ? $keys['bought_on'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Детали оплаты', 'payment_details'); ?>
        <input id="payment_details" type="text" name="payment_details" maxlength="512" value="<?php echo set_value('payment_details', isset($keys['payment_details']) ? $keys['payment_details'] : ''); ?>"  />
</div>

<div>	
	<?php echo form_label('Оплачен', 'is_paid'); ?>               
        <input type="checkbox" id="is_paid" name="is_paid" value="1" <?php echo (isset($keys['is_paid']) && $keys['is_vip'] == 1) ? 'checked="checked"' : set_checkbox('is_paid', 1); ?>> 	
</div> 



	<div class="text-right">
		<br/>
		<input type="submit" name="submit" value="Создать ключ" /> или <?php echo anchor(SITE_AREA .'/content/keys', lang('keys_cancel')); ?>
	</div>
	<?php echo form_close(); ?>
