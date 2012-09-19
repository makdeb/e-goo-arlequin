
<?php if (validation_errors()) : ?>
<div class="notification error">
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs    
if( isset($news) ) {
	$news = (array)$news;
}
$id = isset($news['id']) ? "/".$news['id'] : '';
?>
<?php echo form_open($this->uri->uri_string(), 'class="constrained ajax-form"'); ?>
<div>
        <?php echo form_label('Category', 'news_category'); ?> <span class="required">*</span>
		<?php // Change or Add the radio values/labels/css classes to suit your needs ?>
		<input id="news_category" name="news_category" type="radio" class="" value="option1" <?php echo set_radio('news_category', 'option1', TRUE); ?> />
		<label for="news_category">Radio option 1</label>

		<input id="news_category" name="news_category" type="radio" class="" value="option2" <?php echo set_radio('news_category', 'option2'); ?> />
		<label for="news_category">Radio option 2</label>
</div>


<div>
        <?php echo form_label('Title', 'news_title'); ?> <span class="required">*</span>
        <input id="news_title" type="text" name="news_title" maxlength="255" value="<?php echo set_value('news_title', isset($news['news_title']) ? $news['news_title'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Path to img', 'news_img_path'); ?>
        <input id="news_img_path" type="text" name="news_img_path"  value="<?php echo set_value('news_img_path', isset($news['news_img_path']) ? $news['news_img_path'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Text', 'news_text'); ?> <span class="required">*</span>
	<?php echo form_textarea( array( 'name' => 'news_text', 'id' => 'news_text', 'rows' => '5', 'cols' => '80', 'value' => set_value('news_text', isset($news['news_text']) ? $news['news_text'] : '') ) )?>
</div>


	<div class="text-right">
		<br/>
		<input type="submit" name="submit" value="Edit news" /> or <?php echo anchor(SITE_AREA .'/settings/news', lang('news_cancel')); ?>
	</div>
	<?php echo form_close(); ?>

	<div class="box delete rounded">
		<a class="button" id="delete-me" href="<?php echo site_url(SITE_AREA .'/settings/news/delete/'. $id); ?>" onclick="return confirm('<?php echo lang('news_delete_confirm'); ?>')"><?php echo lang('news_delete_record'); ?></a>
		
		<h3><?php echo lang('news_delete_record'); ?></h3>
		
		<p><?php echo lang('news_edit_text'); ?></p>
	</div>
