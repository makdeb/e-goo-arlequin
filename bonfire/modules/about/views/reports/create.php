
<?php if (validation_errors()) : ?>
<div class="notification error">
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs    
if( isset($about) ) {
	$about = (array)$about;
}
$id = isset($about['id']) ? "/".$about['id'] : '';
?>
<?php echo form_open($this->uri->uri_string(), 'class="constrained ajax-form"'); ?>


	<div class="text-right">
		<br/>
		<input type="submit" name="submit" value="Create About" /> or <?php echo anchor(SITE_AREA .'/reports/about', lang('about_cancel')); ?>
	</div>
	<?php echo form_close(); ?>
