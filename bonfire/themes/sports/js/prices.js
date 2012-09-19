$('a.pc-buy-key-submit').live('click',function(event){
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
            if (data.success) {
                if (data.ik_payment_id!=undefined) {
                    key_order_form.children('[name="ik_payment_id"]').val(data.ik_payment_id);
                }
                key_order_form.submit();
            }
            else {
                if (data.redirect!=undefined) {
                    window.location.href=data.redirect;
                }
            }
        },
        'json'
    );
    event.preventDefault();
});


