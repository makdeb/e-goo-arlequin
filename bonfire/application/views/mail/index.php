<?php if ($success) : ?>

<div class="notification success">
	<p> Ваше письмо было успешно отправлено!</p>
</div>

<?php endif; ?>
<?php if (!$success) : ?>

<div class="notification error">
	<p> Произошла ошибка при отправке сообщения!<br/>
	    Обратитесь к нашим администраторам в группе <a href="http://vk.com/our_easy_victory">Вконтакте</a></p>
</div>
<?php endif; ?>