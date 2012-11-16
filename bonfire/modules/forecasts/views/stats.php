<div id="stats_wrap">

	<div id='stats_content'>
		<p>На этой странице у Вас есть возможность ознакомится со статистикой наших прогнозов за последние несколько месяцев. Мы постарались сделать сводку данной информации максимально удобной для Вас. Чтоб просмотреть статистику за интересующий Вас период, достаточно выбрать нужный месяц. VIP-прогнозы отмечены в списке специальной иконкой. В конце каждого отчетного периода Вы можете увидеть общий итог прогнозов: сколько ставок было сделано, и сколько из них выиграли. Анализируя данную информацию, обращайте внимание на размер коэффициента того или иного прогноза.</p>
		<p>Для нас важно, чтоб наши клиенты нам доверяли, поэтому на страницах сервиса «Easy Victory» мы хотим обеспечить Вам предельную прозрачность нашей работы.</p> 

	</div>
</div>
    <table class="fc-table">
		<thead>
			<th class="fc-is-vip"></th>
			<th class="fc-event-date">Дата</th>	
			<th class="fc-event-name">Событие</th>
			<th class="fc-event-coeff">Коэффициент</th>
			<th class="fc-event-result">Наш прогноз</th>
			<th class="fc-event-true" style="font-size:10px;"> Cтавок за месяц: <?php echo $overall ;?>&nbsp;
				Выиграло: <?php echo $won ;?>	</th>

		</thead>
		<tbody>
		<?php if (isset($records) && is_array($records) && count($records)) : ?>
		<?php foreach ($records as $record) : ?>
			<?php $record = (array)$record;?>
			<tr>
                            <td class="fc-is-vip"><?php if ($record['is_vip']==1) {echo '<img src="'.Template::theme_url().'images/vip_crown.png"/>';};?></td>
							<td class="fc-event-date"><?php echo date('d.m',strtotime($record['event_date']));?></td>
                            <td class="fc-event-name"><?php echo $record['event_name'];?></td>
                            <td class="fc-event-coeff"><?php echo $record['event_coeff'];?></td>
							<td class="fc-event-result"><?php echo $record['event_result'];?></td>
							<td class="fc-event-true"><?php 
                                        switch ((int)$record['forecast_result']) {
                                            case 0:
                                                echo '';
                                                break;
                                            case 1:
                                                echo '<img src="'.Template::theme_url().'images/ico/stats/yes_small.png"/>';
                                                break;
                                            case 2:
                                                echo '<img src="'.Template::theme_url().'images/ico/stats/no_small.png"/>';
                                                break;                                            
                                        }
                                ?></td>
			</tr>
		<?php endforeach; ?>
		<?php endif; ?>
		
			<?php $i = ($month-1) ;?>
			<?php while ($i>0) : ?>

				<?php if($i<9) :?>
					<tr class="stats-links stats-hidden">
	                            <td colspan="7" class="fc-none">
	                                 <a href="#" id="<?php echo $i ;?>" class="fc-get-stats">Показать за <?php echo $monthes[$i] ;?></a>
	                            </td>
		            </tr>
					<?php ($i--) ;?>
				
				<?php else :?>
				
				<tr class="stats-links">
	                            <td colspan="7" class="fc-none">
	                                 <a href="#" id="<?php echo $i ;?>" class="fc-get-stats">Показать за <?php echo $monthes[$i] ;?></a>
	                            </td>
	            </tr>
				<?php ($i--) ;?>
				<?php endif;?>	
			<?php endwhile; ?>	
		</tbody>
	</table>
	
	<div id="share_forec">
	<span class="st_vkontakte" st_title='Актуальные прогнозы от команды Easy Victory'></span>
						<span class="st_facebook" st_title='Актуальные прогнозы от команды Easy Victory'></span>
						<span class="st_twitter" st_title='Актуальные прогнозы от команды Easy Victory'></span>
						<span class="st_odnoklassniki" st_title='Актуальные прогнозы от команды Easy Victory'></span>
						<span class="st_google" st_title='Актуальные прогнозы от команды Easy Victory>'></span>
	</div>