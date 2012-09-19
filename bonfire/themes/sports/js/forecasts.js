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

