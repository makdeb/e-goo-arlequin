
<?php if (validation_errors()) : ?>
<div class="notification error">
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<div id="image_upload_notification" class="notification" style="display:none;">
</div>
<?php // Change the css classes to suit your needs
if( isset($eventscategories) ) {
	$eventscategories = (array)$eventscategories;
}
$id = isset($eventscategories['id']) ? "/".$eventscategories['id'] : '';
?>
<?php echo form_open($this->uri->uri_string(), 'class="constrained ajax-form"'); ?>
<?php if(isset($eventscategories['id'])): ?><input id="id" type="hidden" name="id" value="<?php echo $eventscategories['id'];?>"  /><?php endif;?>
<div>
        <?php echo form_label('Категория', 'event_category_name'); ?>
        <input id="event_category_name" type="text" name="event_category_name" maxlength="45" value="<?php echo set_value('event_category_name', isset($eventscategories['event_category_name']) ? $eventscategories['event_category_name'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Изображение', 'event_category_img'); ?>
        <input id="event_category_img" type="hidden" name="event_category_img" maxlength="100" value=""  />
        <img id="image_preview" src="<?php echo Template::theme_url()?>images/no-photo.png" width="24" height="24"/>
        <input type="button" class="button" id="image_browse" value="Выбрать" />
        <input type="button" class="button" id="image_upload" value="Загрузить"/>
</div>



	<div class="text-right">
		<br/>
		<input type="submit" name="submit" value="Создать категорию" /> или <?php echo anchor(SITE_AREA .'/content/eventscategories', lang('eventscategories_cancel')); ?>
	</div>
	<?php echo form_close(); ?>

<div id="image_upload_hidden_form_wrapper">
    <form id="image_upload_form" action="<?php echo(site_url()); ?>/admin/content/eventscategories/upload_image" class="constrained ajax-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
        <input type="file" name="image_file" size="20">
        <input type="submit" value="upload_image">
    </form>    
</div>
