
<?php if (isset($records) && is_array($records) && count($records)) : ?>
		<?php $i=-1  ;?>
		<?php $uah=array()  ;?>
		<?php $rur=array()  ;?>
		<?php $usd=array()  ;?>
		<?php foreach ($records as $record) : ?>
			<?php $record = (array)$record;?>
			<?php $i = $i+1 ;?>
			<?php foreach($record as $field => $value) : ?>
				
				<?php	
				switch ($field):
				    case 'prices_uah':
				        $uah[$i] = $value;
				        break;
				    case 'prices_rur':
				        $rur[$i] = $value;
				        break;
			            case 'prices_usd':
				        $usd[$i] = $value;	
                                        break;
				    default:
				        $id = $value;
				endswitch;
				?>

			<?php endforeach; ?>

		<?php endforeach; ?>
<?php endif; ?>

<br />

<div id="prices_wrap">

	<p id='prices_head'>Цены и оплата</p>

<div id='prices_content'>

<p>Наш сервис предоставляет прогнозы на тщательно отобранные спортивные события, снижая всевозможные риски ошибиться к минимуму. Даже в категории бесплатных прогнозов Вы ежедневно получаете исходы с хорошей проходимостью. Впрочем, все лучшие прогнозы, с точки зрения линий букмекерских контор, а также с глубоким анализом от наших аналитиков, будут попадать в категорию платных. <br/>У нас не существует какого-либо разделения VIP-прогнозов, поэтому цена на каждый устанавливается одинаковая.</p> 
<p>Стоимость <strong>одного прогноза</strong> составляет <?php echo $uah[0] ;?> гривен, <?php echo $rur[0] ;?> рублей или <?php echo $usd[0] ;?> доллара.</p>

<p>Кроме этого, есть возможность оформить подписку на прогнозы, и получить неограниченный доступ к VIP-прогнозам на выбранный период. Подписка даст возможность Вам также автоматически получать почтовую рассылку при публикации новых платных прогнозов. Ежедневно в VIP-разделе будет появляться от 3 до 5-ти ставок на спорт, так что ни один день Вашей подписки не будет простаивать. </p>

<p>Стоимость <strong>подписки ко всем прогнозам</strong> сроком на:</p>
<p><ul>
	<li>1 день - <?php echo $uah[1] ;?> гривен, <?php echo $rur[1] ;?> рублей или <?php echo $usd[1] ;?> долларов</li>
	<li>7 дней - <?php echo $uah[2] ;?> гривен, <?php echo $rur[2] ;?> рублей или <?php echo $usd[2] ;?> долларов</li>
	<li>15 дней - <?php echo $uah[3] ;?> гривен, <?php echo $rur[3] ;?> рублей или <?php echo $usd[3] ;?> долларов</li>
	<li>30 дней - <?php echo $uah[4] ;?> гривен, <?php echo $rur[4] ;?> рублей или <?php echo $usd[4] ;?> долларов</li>
</ul></p>

<div id="prices">
	<div class="buy_wrap">
		<div class='buy'>ПОДПИСКА<br/>на 1 день</div>
		<div class="descript"><span><h1>День</h1><br/>
									<p>Полный доступ</p>
									<p>Лучшие прогнозы</p>
									<p>Детальный анализ</p>
									<p>Почтовая рассылка</p>
									<p class="purchase">
                                                                            <a href="#" class="pc-buy-key-submit">ОПЛАТИТЬ</a>
                                                                            <form name="payment" action="<?php echo $keys_config['ik_url'] ?>" method="post" target="_blank">
                                                                            <input type="hidden" name="ik_shop_id" value="<?php echo $keys_config['ik_shop_id'] ?>">
                                                                            <input type="hidden" name="ik_payment_amount" value="<?php echo $forms_data[0]['key_price']; ?>">
                                                                            <input type="hidden" name="ik_payment_id" value="">
                                                                            <input type="hidden" name="ik_payment_desc" value="Ключ доступа к прогнозам на <?php echo $forms_data[0]['prices_name'];?>">
                                                                            <input type="hidden" name="ik_paysystem_alias" value="">
                                                                            <input type="hidden" name="ik_baggage_fields" value="<?php echo $forms_data[0]['key']; ?>">
                                                                            <input type="hidden" name="ik_form_hash" value="<?php echo $forms_data[0]['form_hash']; ?>">
                                                                            </form>                                                                            
                                                                        </p>
									
									<p class="cost"><em><?php echo $uah[1] ;?></em>&nbsp;грн<br/><b><?php echo $rur[1] ;?></b>&nbsp;руб / <b> <?php echo $usd[1] ;?>&nbsp;$</b>
									</p>
									
									
									</span>
                </div>
	</div>
	
	<div class="buy_wrap">
		<div class='buy'>ПОДПИСКА<br/>на 7 дней</div>
		<div class="descript"><span><h1>7 Дней</h1><br/>
									<p>Полный доступ</p>
									<p>Лучшие прогнозы</p>
									<p>Детальный анализ</p>
									<p>Почтовая рассылка</p>
									<p class="purchase">
                                                                            <a href="#" class="pc-buy-key-submit">ОПЛАТИТЬ</a>
                                                                            <form name="payment" action="<?php echo $keys_config['ik_url'] ?>" method="post" target="_blank">
                                                                            <input type="hidden" name="ik_shop_id" value="<?php echo $keys_config['ik_shop_id'] ?>">
                                                                            <input type="hidden" name="ik_payment_amount" value="<?php echo $forms_data[1]['key_price']; ?>">
                                                                            <input type="hidden" name="ik_payment_id" value="">
                                                                            <input type="hidden" name="ik_payment_desc" value="Ключ доступа к прогнозам на <?php echo $forms_data[1]['prices_name'];?>">
                                                                            <input type="hidden" name="ik_paysystem_alias" value="">
                                                                            <input type="hidden" name="ik_baggage_fields" value="<?php echo $forms_data[1]['key']; ?>">
                                                                            <input type="hidden" name="ik_form_hash" value="<?php echo $forms_data[1]['form_hash']; ?>">
                                                                            </form>                                                                         
                                                                        </p>
									
									<p class="cost"><em><?php echo $uah[2] ;?></em>&nbsp;грн<br/><b><?php echo $rur[2] ;?></b>&nbsp;руб / <b> <?php echo $usd[2] ;?>&nbsp;$</b>
									</p>
									
									</span>                   
                </div>
	</div>
	
	<div class="buy_wrap">
		<div class='buy'>ПОДПИСКА<br/>на 15 дней</div>
		<div class="descript"><span><h1>15 Дней</h1><br/>
									<p>Полный доступ</p>
									<p>Лучшие прогнозы</p>
									<p>Детальный анализ</p>
									<p>Почтовая рассылка</p>
									<p class="purchase">
                                                                            <a href="#" class="pc-buy-key-submit">ОПЛАТИТЬ</a>
                                                                            <form name="payment" action="<?php echo $keys_config['ik_url'] ?>" method="post" target="_blank">
                                                                            <input type="hidden" name="ik_shop_id" value="<?php echo $keys_config['ik_shop_id'] ?>">
                                                                            <input type="hidden" name="ik_payment_amount" value="<?php echo $forms_data[2]['key_price']; ?>">
                                                                            <input type="hidden" name="ik_payment_id" value="">
                                                                            <input type="hidden" name="ik_payment_desc" value="Ключ доступа к прогнозам на <?php echo $forms_data[2]['prices_name'];?>">
                                                                            <input type="hidden" name="ik_paysystem_alias" value="">
                                                                            <input type="hidden" name="ik_baggage_fields" value="<?php echo $forms_data[2]['key']; ?>">
                                                                            <input type="hidden" name="ik_form_hash" value="<?php echo $forms_data[2]['form_hash']; ?>">
                                                                            </form>                                                                              
                                                                        </p>
									
									<p class="cost"><em><?php echo $uah[3] ;?></em>&nbsp;грн<br/><b><?php echo $rur[3] ;?></b>&nbsp;руб / <b> <?php echo $usd[3] ;?>&nbsp;$</b>
									</p>
									
							 </span>                  
                </div>
	</div>


	<div class="buy_month">
		<div class='buy'>ПОДПИСКА<br/>на 1 месяц</div>
		<div class="descript"><span><h1>Месяц</h1><br/>
										<p>Полный доступ</p>
										<p>Лучшие прогнозы</p>
										<p>Детальный анализ</p>
										<p>Почтовая рассылка</p>
										<p class="purchase">
                                                                                    <a href="" class="pc-buy-key-submit">ОПЛАТИТЬ</a>
                                                                                    <form name="payment" action="<?php echo $keys_config['ik_url'] ?>" method="post" target="_blank">
                                                                                    <input type="hidden" name="ik_shop_id" value="<?php echo $keys_config['ik_shop_id'] ?>">
                                                                                    <input type="hidden" name="ik_payment_amount" value="<?php echo $forms_data[3]['key_price']; ?>">
                                                                                    <input type="hidden" name="ik_payment_id" value="">
                                                                                    <input type="hidden" name="ik_payment_desc" value="Ключ доступа к прогнозам на <?php echo $forms_data[3]['prices_name'];?>">
                                                                                    <input type="hidden" name="ik_paysystem_alias" value="">
                                                                                    <input type="hidden" name="ik_baggage_fields" value="<?php echo $forms_data[3]['key']; ?>">
                                                                                    <input type="hidden" name="ik_form_hash" value="<?php echo $forms_data[3]['form_hash']; ?>">
                                                                                    </form>                                                                                 
										</p>
										<p class="cost"><em><?php echo $uah[4] ;?></em>&nbsp;грн<br/><b><?php echo $rur[4] ;?></b>&nbsp;руб / <b> <?php echo $usd[4] ;?>&nbsp;$</b>
										</p>
																			
								 </span>                    
                </div>
	</div>
</div>
<br/>
<p>Приобретение подписки производится через сервис нашего партнера interkassa.com, на котором Вы можете выбрать наиболее удобный для Вас способ оплаты. На сегодняшний день доступны следующие способы: 

<ul id='prices_types'>
<?php /* <li><img src="<?php echo Template::theme_url()?>images/webmoney.gif" /></li> */ ;?>
	<li><img src="<?php echo Template::theme_url()?>images/visamaster-logo_edited1.png" /></li>
	<li><img src="<?php echo Template::theme_url()?>images/yandexmoney.gif" /></li>
	<li><img src="<?php echo Template::theme_url()?>images/liqpay-logo.png" /></li>
	<li><img src="<?php echo Template::theme_url()?>images/qiwi-logo.png" /></li>
	<li><img src="<?php echo Template::theme_url()?>images/telemoney_logo.png" />&nbsp;&nbsp;</li>
	<li><img src="<?php echo Template::theme_url()?>images/mts.jpg" /></li>
	<li><img src="<?php echo Template::theme_url()?>images/megafon.jpg" /></li>
</ul>
</p>
<br style="clear: left;" /><br/>
<p>Если у Вас остались вопросы, пишите нам через форму <a href="#connect" style="color:#61380B">обратной связи</a></p>

</div>
</div>