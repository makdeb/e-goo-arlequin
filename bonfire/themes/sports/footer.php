<?php header('Content-type: text/html; charset=utf-8')?>
<div id="footer">

			<div id='foo_left'>
		
			<div id='one'>
				<span style='height:45px; font-family: Verdana,Georgia,Arial; font-size: 20px; padding-top: 30px;'>Ссылки</span>
				<span><a href="http://www.bukmekerskiekontory.info/">Букмекерские конторы</a></span>
				<span><a href="http://livetv.ru/livescore/">Результаты on-line</a></span>
				<span><a href="http://livetv.ru/allupcoming/">Онлайн трансляции</a></span>

				
			</div>
		
			<div id='two'>
				<span style='height:45px; font-family: Verdana,Georgia,Arial; font-size: 20px; padding-top: 30px;'>Категории</span>
				<span><a href="/forecasts">Последние прогнозы</a></span>
				<span><a href="/prices">Цены и оплата</a></span>
				<span><a href="/news">Новости спорта</a></span>

				<span><a href="/about/service">FAQ по сервису</a></span>
				<span><a href="/about/bets">FAQ по ставкам</a></span>
			</div>
		</div>
		
		<div id='foo_right'>
		<p>Обратная связь</p>
		<form id='connect' name='connect'>
			<input id='email' type='email' name='email' placeholder="E-mail:" required pattern="^\s*\w+@\w+\.\w+\s*$"  /> <br>
			<textarea name='text' type='text' placeholder="Message:" rows='9' required></textarea><br>
			<input type="image" id='submit' src="<?php echo Template::theme_url()?>images/submit_button.png">
		</form>	

		</div>		



		<div id='last'>
			<p> Copyright &copy; 2012 	</p>		
		</div>
	</div>	