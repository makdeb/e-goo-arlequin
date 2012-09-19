
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
<?php
if(!isset($error)) {
$error = 'Выберите изображение';
}
if(!isset($img)) {
$img ='';	
}
?>

<div id='upload'>
	<p><?php echo $error;?></p>
	<p><?php echo $img;?></p>
	<form id="upload" action="http://easyvictory.com.ua/admin/reports/news/create" class="constrained ajax-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">

	<input type="file" name="userfile" size="20"><br />
	<p><input type="hidden" name="submitted" id='check' value="1″ size="1"></p>
	<input type="submit" value="upload">
	</form>

</div>

<?php echo form_open($this->uri->uri_string(), 'class="constrained ajax-form"'); ?>
<div>
        <?php echo form_label('Категория', 'news_category'); ?> <span class="required">*</span>
		<?php // Change or Add the radio values/labels/css classes to suit your needs ?>
		
<?php /*		
		<input id="news_category" name="news_category" type="radio" class="" value="football" <?php echo set_radio('news_category', 'Футбол', TRUE); ?> />
		<label for="news_category">Футбол</label>

		<input id="news_category" name="news_category" type="radio" class="" value="basketball" <?php echo set_radio('news_category', 'Баскетбол'); ?> />
		<label for="news_category">Баскетбол</label>
		
		<input id="news_category" name="news_category" type="radio" class="" value="hockey" <?php echo set_radio('news_category', 'Хоккей'); ?> />
		<label for="news_category">Хоккей</label>
		
		<input id="news_category" name="news_category" type="radio" class="" value="tennis" <?php echo set_radio('news_category', 'Теннис'); ?> />
		<label for="news_category">Теннис</label>
		
		<input id="news_category" name="news_category" type="radio" class="" value="box" <?php echo set_radio('news_category', 'Бокс'); ?> />
		<label for="news_category">Бокс</label>
		
		<input id="news_category" name="news_category" type="radio" class="" value="other" <?php echo set_radio('news_category', 'Другие'); ?> />
		<label for="news_category">Другие</label>
*/		
?>		
	
	
	
	<?php $options = array(
				'football' => 'Футбол',
				'basketball' => 'Баскетбол',
				'hockey' => 'Хоккей',
				'tennis' => 'Тенис',
				'box' => 'Бокс',
				'auto' => 'Автоспорт',
				'other' => 'Другие'
); ?>
		
		<?php echo form_dropdown('news_category', $options, set_value('news_category', isset($news['news_category']) ? $news['news_category'] : ''))?>
					
</div>


<div>
        <?php echo form_label('Заголовок', 'news_title'); ?> <span class="required">*</span>
        <input id="news_title" type="text" name="news_title" maxlength="255" value="<?php echo set_value('news_title', isset($news['news_title']) ? $news['news_title'] : ''); ?>"  />
</div>

<div>
        <?php echo form_label('Краткое описание', 'news_short'); ?> <span class="required">*</span>
	<?php echo form_textarea( array( 'name' => 'news_short', 'id' => 'news_short', 'rows' => '3', 'cols' => '50', 'value' => set_value('news_short', isset($news['news_short']) ? $news['news_short'] : '') ) )?>
</div>

<div>
        <?php echo form_label('Новость', 'news_text'); ?> <span class="required">*</span>
	<?php echo form_textarea( array( 'name' => 'news_text', 'id' => 'news_text', 'rows' => '5', 'cols' => '80', 'value' => set_value('news_text', isset($news['news_text']) ? $news['news_text'] : '') ) )?>
</div>

<script type="text/javascript">
_editor_url = "/bonfire/themes/admin/js/editors/xinha/";
_editor_lang = "ru";
_editor_skin = "green-look"; 
_editor_icons = "Classic";
</script>	
<script type="text/javascript" src="/bonfire/themes/admin/js/editors/xinha/XinhaCore.js"></script>	
	
<script type="text/javascript" src="/bonfire/themes/admin/js/editors/xinha/my_config.js"></script>


<div>
		<?php echo form_label('Источник', 'news_author'); ?>
		<input id="news_author" type="text" name="news_author" value="<?php echo set_value('news_author', isset($news['news_author']) ? $news['news_author'] : ''); ?>"  />
</div>

	<div class="text-right">
		<br/>
		<input type="submit" name="submit" value="Создать новость" /> or <?php echo anchor(SITE_AREA .'/reports/news', lang('news_cancel')); ?>
	</div>
	<?php echo form_close(); ?>
