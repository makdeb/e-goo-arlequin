<?php header('Content-type: text/html; charset=utf-8')?>
				<a id='vip_aside' href="/prices">
				<div id='aside1'>
					<span><p>ежедневное<br /> обновление <br /><br />
						  
						  высокие<br /> коэффициенты <br /><br />
						  
						  детальные описания <br /><br />
						  
						  почтовая рассылка
						  </p>
					
					
					</span>
				</div></a>
				<div id='aside2'>
					<div></div>
					<ul>
						<li><a href="/forecasts">Прогнозы</a></li>
						<li><a href="/forecasts/stats">Статистика</a></li>
						<li><a href="/prices">Цены и оплата</a></li>
						<li><a href="/news">Новости спорта</a></li>
						<li><a href="/about/service">FAQ по сервису</a></li>
						<li><a href="/about/bets">FAQ по ставкам</a></li>
						<li><a href="/about">О нас</a></li>

					</ul>
									
				</div>
				<div id='aside3'>
				
				<p><a href='#'>Прогнозы на спорт</a> публикуются каждый день в разное время. Следите за анонсами.</p>
				<p>По вопросам работы сервиса, а также со своими пожеланиями, обращайтесь через <a href='#connect'>обратную связь</a></p>
				
				<!--acessing our userdata cookie-->
				
				<?php 
					$cookie = unserialize($this->input->cookie($this->config->item('sess_cookie_name')));
					$logged_in = isset ($cookie['logged_in']);
					unset ($cookie);
						
					if ($logged_in) : ?>
					
					<p>
						Изменить данные своего профиля, а также пароль входа на наш сайт можно <a href="<?php echo site_url('users/profile');?>">здесь</a>
					</p>
					
					<?php endif;?>
					
				</div>
								<!-- Start of Vibiray.com Code -->
				<center><script type="text/javascript">
				    setTimeout(function() {
				        var el = document.createElement('script');
				        el.type = 'text/javascript';
				        el.src = '//www.vibiray.com/export/informer/212.js';
				        el.async = true;
				        document.getElementById('InformerVibiray-212').appendChild(el);
				    }, 0);
				</script>
				<div id="InformerVibiray-212" align="center" style="width:250px;height:250px;margin:0 auto;">
				<a href="http://www.vibiray.com">Интернет Торговый Центр "Выбирай.com"</a>
				</div></center>
				<!-- End of Vibiray.com Code -->