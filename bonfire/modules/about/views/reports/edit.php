
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
		<input type="submit" name="submit" value="Edit About" /> or <?php echo anchor(SITE_AREA .'/reports/about', lang('about_cancel')); ?>
	</div>
	<?php echo form_close(); ?>

	<div class="box delete rounded">
		<a class="button" id="delete-me" href="<?php echo site_url(SITE_AREA .'/reports/about/delete/'. $id); ?>" onclick="return confirm('<?php echo lang('about_delete_confirm'); ?>')"><?php echo lang('about_delete_record'); ?></a>
		
		<h3><?php echo lang('about_delete_record'); ?></h3>
		
		<p><?php echo lang('about_edit_text'); ?></p>
	</div>
