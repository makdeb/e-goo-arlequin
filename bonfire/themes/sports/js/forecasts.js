function refresh_remaning_time() {
    $('.fc-event-date').each(function (index) {
        var now=new Date();
        var event_date=new Date();
        event_date.setTime(Date.parse(this.getAttribute('value')));
        if (now>event_date) {
            $(this).parent().html('началось');
        }
        else {
            var date_diff=event_date-now;
            var days=Math.floor(date_diff/(1000*60*60*24));
            var days_r=date_diff%(1000*60*60*24);
            var hours=Math.floor(days_r/(1000*60*60));
            var hours_r=days_r%(1000*60*60);
            var mins=Math.floor(hours_r/(1000*60));
            var mins_r=hours_r%(1000*60);
            var secs=Math.floor(mins_r/(1000));
            var date_diff_str='';
            if (days>0) {
                date_diff_str=days.toString()+' дней ';    
            }            
            if (hours<10) {
                date_diff_str+='0'+hours.toString()+':'
            }
            else {
                date_diff_str+=hours.toString()+':';
            }
            if (mins<10) {
                date_diff_str+='0'+mins.toString()+':';
            }
            else {
                date_diff_str+=mins.toString()+':';
            }
            if (secs<10) {
                date_diff_str+='0'+secs.toString();
            }
            else {
                date_diff_str+=secs.toString();
            }            
            $(this).parent().find('span').html(date_diff_str);           
        }
    });
}

refresh_remaning_time();
setInterval(refresh_remaning_time,1000);

$('a.fc-get-details').live('click',function (event) {
    var sender = $(this);
    if (sender.parents('tr').hasClass('fc-expanded')) {
        sender.parents('tr').removeClass('fc-expanded').next('.fc-description').remove();        
    }
    else {
        $.post(
            'forecasts/get_forecast',
            {forecast_id: this.getAttribute('id')},
            function (data) {
                if (!data.success) { 
                    if ((data.buy_text==undefined)||(data.buy_form==undefined)) {
                        window.location.href = data.redirect;
                    }
                    else {
                        var forecast_data = $('<tr text-align="center" class="fc-description"><td colspan=7></td></tr>');
                        forecast_data.find('td').html(data.buy_text+data.buy_form);
                        sender.parents('tr').addClass('fc-expanded').after(forecast_data);
                    }                    
                }
                else {
                    var forecast_data = $('<tr class="fc-description"><td colspan=7></td></tr>');
                    forecast_data.find('td').html(data.forecast_desc+'</br>'+'<b>Прогнозируемый результат: '+data.forecast_result+'</b>');
                    sender.parents('tr').addClass('fc-expanded').after(forecast_data);
                }
            },
            'json'
        );
    }
    event.preventDefault();
});

$('a.fc-get-stats').live('click',function (event) {
	
	var sender = $(this);
	var today = new Date();
	var yr = today.getFullYear();// текущий год
	// закрываем блок статистики
	if (sender.parents('tr').hasClass('fc-expanded')) {
			sender.parents('tr').removeClass('fc-expanded').nextUntil('.stats-links').remove()
   }
    else {
	$.post(
            'forecasts/get_stats',
            {month: this.getAttribute('id'),year: yr},// передаем месяц и год php-скрипту
            function (data) {
                 if (!data.success) { //если произошла ошибка при кодировании json
						var stats_data = $('<tr text-align="center" class="fc-description error"><td colspan=7></td></tr>');
                        stats_data.find('td').html('<b>Ошибка при извлечении данных</b>');
						sender.parents('tr').addClass('fc-expanded').after(stats_data);
                    } else if (data.all=='0') { //если количество прогнозов за месяц нулевое
						var stats_data = $('<tr text-align="center" class="fc-description"><td colspan=7></td></tr>');
                        stats_data.find('td').html('<b>Отсутствуют данные за этот месяц</b>');
						sender.parents('tr').addClass('fc-expanded').after(stats_data);
                      } 
					  else { //если ошибок нет
					  	var count = parseInt(data.all);//количество прогнозов в блоке
						
						var chosen_month = data.stats[0].event_date;
						chosen_month = chosen_month.substr(chosen_month.length-2,2);//выбираем из полученной строки номер выбранного месяца
						// массив соответствий названий месяцов
						var monthes = {'01':'Январь','02':'Февраль','03':'Март','04':'Апрель','05':'Май','06':'Июнь','07':'Июль','08':'Август','09':'Сентябрь','10':'Октябрь','11':'Ноябрь','12':'Декабрь'};
						
						var overall_data = $('<tr class="fc-description fc-month"><td colspan=7></td></tr>'); //здесь будет обобщающяя статистика
						// цикл вставки каждого поля того или иного прогноза
						for (i=0; i<count; i++) {
							var stats_data = $('<tr class="fc-description"><td class="fc-is-vip"></td><td class="fc-event-date"></td><td class="fc-event-name"></td><td class="fc-event-coeff"></td><td class="fc-event-result"></td><td class="fc-event-true"></td></tr>');
                        	if (data.stats[i].is_vip=='1') {
								stats_data.find('td:eq(0)').html('<img src="/bonfire/themes/sports/images/vip_crown.png">');
							} else {
								stats_data.find('td:eq(0)').html('&nbsp;');
							}							
							stats_data.find('td:eq(1)').html(data.stats[i].event_date);
							stats_data.find('td:eq(2)').html(data.stats[i].event_name);
							stats_data.find('td:eq(3)').html(data.stats[i].event_coeff);
							stats_data.find('td:eq(4)').html(data.stats[i].event_result);
							if (data.stats[i].forecast_result=='1') {
								stats_data.find('td:eq(5)').html('<img src="/bonfire/themes/sports/images/ico/stats/yes_small.png">');
							} else {
								stats_data.find('td:eq(5)').html('<img src="/bonfire/themes/sports/images/ico/stats/no_small.png">');
							}
							sender.parents('tr').addClass('fc-expanded').after(stats_data);
						}
						// вставляем обобщающую информацию
						overall_data.find('td').html('<b>Ставок за '+monthes[chosen_month]+':'+data.all+'&nbsp;Выиграло:'+data.won+'</b>');
						sender.parents('tr:last').nextUntil('.stats-links').eq(count-1).after(overall_data);
					  }                    
            },
            'json'
        );
	}
	event.preventDefault();
});

$('a.fc-buy-forecast-submit').live('click',function(event){
    var key_order_form=$(this).parent().siblings('form');
    $.post(
        'keys/prepare_key_order',
        {
            ik_url: key_order_form.attr('action'),
            ik_shop_id: key_order_form.children('[name="ik_shop_id"]').val(),
            ik_baggage_fields: key_order_form.children('[name="ik_baggage_fields"]').val(),
            ik_payment_amount: key_order_form.children('[name="ik_payment_amount"]').val(),
            ik_payment_id: key_order_form.children('[name="ik_payment_id"]').val(),
            ik_form_hash: key_order_form.children('[name="ik_form_hash"]').val()
        },
        function (data) {
            if (data.ik_payment_id!=undefined) {
                key_order_form.children('[name="ik_payment_id"]').val(data.ik_payment_id);
            }            
            if (data.success) {
                key_order_form.submit();
            }
        },
        'json'
    );
    event.preventDefault();
});

