<style type="text/css">
	body {
		background: #ffffff url(/bonfire/themes/sports/images/background2.png) 0 1px repeat-x;
	}

</style>

<h2>Изменение Пароля</h2>

<p>Введите Ваш новый пароль внизу.</p>

<?php if (auth_errors() || validation_errors()) : ?>
<div class="notification error">
	<?php echo auth_errors() . validation_errors(); ?>
</div>
<?php endif; ?>

<?php echo form_open(current_url()) ?>
	<input type="hidden" name="user_id" value="<?php echo $user->id ?>" />

	<label for="password"><?php echo lang('bf_password'); ?></label>
	<input type="text" name="password" placeholder="Пароль..." />
	<p class="small"><?php echo lang('us_password_mins'); ?></p>
	
	<label for="pass_confirm"><?php echo lang('bf_password_confirm'); ?></label>
	<input type="text" name="pass_confirm" placeholder="Снова..." />
	
	<div class="submits">
		<input type="submit" name="submit" value="Сохранить новый пароль" />
	</div>

<?php echo form_close(); ?>