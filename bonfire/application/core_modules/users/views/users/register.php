<style type="text/css">
	body {
		background: #ffffff url(/bonfire/themes/sports/images/background2.png) 0 1px repeat-x;
	}

</style>

<h2><?php echo lang('us_login'); ?></h2>

<?php if (auth_errors() || validation_errors()) : ?>
<div class="notification error">
	<?php echo auth_errors() . validation_errors(); ?>
</div>
<?php endif; ?>

<p class="small"><?php echo lang('bf_required_note'); ?></p>

<?php echo form_open($this->uri->uri_string()); ?>

	<label for="email" class="required"><?php echo lang('bf_email'); ?></label>
	<input type="text" name="email" id="email"  value="<?php echo set_value('email'); ?>"  placeholder="email" />
	<br/>
	<?php if ( $this->settings_lib->item('auth.login_type') !== 'email' OR $this->settings_lib->item('auth.use_usernames') == 1): ?>
		<label class="required" for="username"><b><?php echo lang('bf_username'); ?></b></label>
		<input type="text" name="username" id="username" value="<?php echo set_value('username') ?>" placeholder="имя пользователя" />
	<?php endif; ?>
	<br/>
	<?php if ($this->settings_lib->item('auth.use_own_names')) : ?>
	<div>
		<label><?php echo lang('us_first_name'); ?></label>
		<input type="text" id="first_name" name="first_name" value="<?php echo set_value('first_name') ?>" />
		<br/>
		<label><?php echo lang('us_last_name'); ?></label>
		<input type="text" id="last_name" name="last_name" value="<?php echo set_value('last_name') ?>"  />
	</div>

	<?php endif; ?>	
	<div>
		<label class="required" for="password"><b><?php echo lang('bf_password'); ?></b></label>
		<input type="password" name="password" id="password" value="" placeholder="Пароль" />
		<p class="small"><?php echo lang('us_password_mins'); ?></p>
	
		<label class="required" for="pass_confirm"><b><?php echo lang('bf_password_confirm'); ?></b></label>
		<input type="password" name="pass_confirm" id="pass_confirm" value="" placeholder="<?php echo lang('bf_password_confirm'); ?>" />
	</div>
	<div class="submits">
		<input type="submit" name="submit" id="submit" value="<?php echo lang('us_register'); ?>"  />	
	</div>

<?php echo form_close(); ?>

<p style="text-align: center">
	<?php echo lang('us_already_registered'); ?> <?php echo anchor('/login', lang('bf_action_login')); ?>
</p>
	
		