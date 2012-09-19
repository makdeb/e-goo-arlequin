
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
        <?php echo form_label('Key', 'key'); ?>
        <input id="key" type="text" name="key" maxlength="32" value="<?php echo set_value('key', isset($keys['key']) ? $keys['key'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Key Owner', 'key_owner'); ?>
        <input id="key_owner" type="text" name="key_owner" maxlength="1" value="<?php echo set_value('key_owner', isset($keys['key_owner']) ? $keys['key_owner'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Valid Untill', 'valid_untill'); ?>
			<script>head.ready(function(){$('#valid_untill').datetimepicker({ dateFormat: 'yy-mm-dd', timeFormat: 'hh:mm:ss'});});</script>
        <input id="valid_untill" type="text" name="valid_untill" maxlength="1" value="<?php echo set_value('valid_untill', isset($keys['valid_untill']) ? $keys['valid_untill'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Bought On', 'bought_on'); ?>
			<script>head.ready(function(){$('#bought_on').datetimepicker({ dateFormat: 'yy-mm-dd', timeFormat: 'hh:mm:ss'});});</script>
        <input id="bought_on" type="text" name="bought_on" maxlength="1" value="<?php echo set_value('bought_on', isset($keys['bought_on']) ? $keys['bought_on'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Payment Details', 'payment_details'); ?>
        <input id="payment_details" type="text" name="payment_details" maxlength="512" value="<?php echo set_value('payment_details', isset($keys['payment_details']) ? $keys['payment_details'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Is Paid', 'is_paid'); ?>
        <input id="is_paid" type="text" name="is_paid" maxlength="6" value="<?php echo set_value('is_paid', isset($keys['is_paid']) ? $keys['is_paid'] : ''); ?>"  />
</div>



	<div class="text-right">
		<br/>
		<input type="submit" name="submit" value="Create keys" /> or <?php echo anchor(SITE_AREA .'/developer/keys', lang('keys_cancel')); ?>
	</div>
	<?php echo form_close(); ?>
