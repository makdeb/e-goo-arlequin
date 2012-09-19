<div id='header'>
		<a id="face" class='social' href="/" title="facebook">Face</a>
	   	<a id="vko" class='social' href="http://vk.com/our_easy_victory" title="vk">VK</a>
 		<a id="twitter" class='social' href="/" title="twitter">Twitter</a>
	   	<a id="prognoses" href="/forecasts" title="Свежие прогнозы">Forecasts</a>
 		<a id="prises" href="/prices" title="Цены и оплата">Prices</a>
       	<a id="sport" href="/news" title="Новости">Sport</a>
       	<a id="about" href="/about"  title="О нас">About</a>
		<!--<img src="/images/auth_but/button_auth3.png">-->
		<a id="logo" href="#"></a>
		
		<!--Вход или Выход?-->
				
				<?php 
					$cookie = unserialize($this->input->cookie($this->config->item('sess_cookie_name')));
					$logged_in = isset ($cookie['logged_in']);
					unset ($cookie);
						
					if ($logged_in) : ?>
					
					<a id="button" href="<?php echo site_url('logout');?>"><span>Выйти</span></a><div></div>
					
					<?php else :?>
					
					<a id="button" href="<?php echo site_url('login');?>"><span>Войти</span></a><div></div>
					
					<?php endif;?>

		
</div>
		<div id='slider'>
			  <div><img src='<?php echo Template::theme_url()?>images/tennis_slide2.jpg' alt='Прогнозы специалистов на спортивные события' /></div>
		</div>
		<div id='circles'>
			<p>
			<a href='<?php echo Template::theme_url()?>images/tennis_slide2.jpg'></a>
			<a href='<?php echo Template::theme_url()?>images/hockey_slide_text3.jpg'></a>
			<a href='<?php echo Template::theme_url()?>images/football_slide1.jpg'></a>
			</p>
		</div>