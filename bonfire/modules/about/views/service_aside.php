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
						<li><a href="/about/service">Visa/Mastercard</a></li>
						<li><a href="/about/yandex_money">Яндекс.Деньги</a></li>
						<li><a href="/about/qiwi">QIWI кошелек</a></li>
						<li><a href="/about/liqpay">Liqpay</a></li>
						<li><a href="/about/telemoney">Telemoney</a></li>
						<li><a href="/about/mobile">Мобильные платежи</a></li>
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