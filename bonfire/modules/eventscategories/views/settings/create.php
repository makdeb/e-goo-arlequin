
<?php if (validation_errors()) : ?>
<div class="notification error">
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs    
if( isset($eventscategories) ) {
	$eventscategories = (array)$eventscategories;
}
$id = isset($eventscategories['id']) ? "/".$eventscategories['id'] : '';
?>
<?php echo form_open($this->uri->uri_string(), 'class="constrained ajax-form"'); ?>
<?php if(isset($eventscategories['id'])): ?><input id="id" type="hidden" name="id" value="<?php echo $eventscategories['id'];?>"  /><?php endif;?>
<div>
        <?php echo form_label('Event Category Name', 'event_category_name'); ?> <span class="required">*</span>
        <input id="event_category_name" type="text" name="event_category_name" maxlength="45" value="<?php echo set_value('event_category_name', isset($eventscategories['event_category_name']) ? $eventscategories['event_category_name'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Event Category Img', 'event_category_img'); ?>
        <input id="event_category_img" type="text" name="event_category_img" maxlength="100" value="<?php echo set_value('event_category_img', isset($eventscategories['event_category_img']) ? $eventscategories['event_category_img'] : ''); ?>"  />
</div>



	<div class="text-right">
		<br/>
		<input type="submit" name="submit" value="Create eventscategories" /> or <?php echo anchor(SITE_AREA .'/settings/eventscategories', lang('eventscategories_cancel')); ?>
	</div>
	<?php echo form_close(); ?>
