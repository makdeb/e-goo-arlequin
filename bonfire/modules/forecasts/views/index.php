        <table class="fc-table">
		<thead>
		
			
		<th class="fc-is-vip"></th>
		<th class="fc-event-name">Событие</th>
		<th class="fc-event-category">Вид спорта</th>
		<th class="fc-event-coeff">Коэффициент</th>
		<th class="fc-event-date">Дата</th>
                <th class="fc-event-time_remaning">До начала</th>
                <th class="fc-get-forecast-button"></th>
		
		</thead>
		<tbody>
		<?php if (isset($records) && is_array($records) && count($records)) : ?>
		<?php foreach ($records as $record) : ?>
			<?php $record = (array)$record;?>
			<tr>
                            <td class="fc-is-vip"><?php if ($record['IS_VIP']==1) {echo '<img src="'.Template::theme_url().'images/vip_crown.png"/>';};?></td>
                            <td class="fc-event-name"><?php echo $record['EVENT_NAME'];?></td>
                            <td class="fc-event-category">
                                <img style="vertical-align: middle;" src="<?php echo base_url().$record['EVENT_CATEGORY_IMG'];?>" title="<?php echo $record['EVENT_CATEGORY_NAME'];?>"/>
                                <a href="#" style="margin-left: 5px;"><?php echo $record['EVENT_CATEGORY_NAME'];?></a>
                            </td>
                            <td class="fc-event-coeff"><?php echo $record['EVENT_COEFF'];?></td>
                            <td class="fc-event-date"><?php echo date('d.m.Y',strtotime($record['EVENT_DATE']));?></td>
                            <td class="fc-event-time_remaning"><span></span><input type="hidden" class="fc-event-date" value="<?php echo date('m/d/Y H:i:s',strtotime($record['EVENT_DATE'])); ?>"></td>
                            <td class="fc-get-forecast-button"><a href="#" id="<?php echo $record['FORECAST_ID'];?>" class="fc-get-details">Прогноз</a></td>
			</tr>
		<?php endforeach; ?>
                <?php else : ?>        
                        <tr>
                            <td colspan="7" id="fc-none">
                                На данный момент нет актуальных прогнозов
                            </td>
                        </tr>
                <?php endif; ?>        
		</tbody>
	</table>
	
	<div id="share_forec">
	<span class="st_vkontakte" st_title='Актуальные прогнозы от команды Easy Victory'></span>
						<span class="st_facebook" st_title='Актуальные прогнозы от команды Easy Victory'></span>
						<span class="st_twitter" st_title='Актуальные прогнозы от команды Easy Victory'></span>
						<span class="st_odnoklassniki" st_title='Актуальные прогнозы от команды Easy Victory'></span>
						<span class="st_google" st_title='Актуальные прогнозы от команды Easy Victory>'></span>
	</div>					
							