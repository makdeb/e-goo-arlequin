$('a.pc-buy-key-submit').live('click',function(event){
    var key_order_form=$(this).parent().siblings('form');
    $.post(
        'http://localhost/keys/prepare_key_order',
        {
            ik_url: key_order_form.attr('action'),
            shop_id: key_order_form.children('[name="ik_shop_id"]').val(),
            baggage_fields: key_order_form.children('[name="ik_baggage_fields"]').val(),
            key_price: key_order_form.children('[name="ik_payment_amount"]').val(),
            order_id: key_order_form.children('[name="ik_payment_id"]').val(),
            form_hash: key_order_form.children('[name="ik_form_hash"]').val()
        },
        function (data) {
            if (data.success) {
                alert('success');
                if (data.payment_id!=undefined) {
                    key_order_form.children('[name="ik_payment_id"]').val(data.payment_id);
                }
                if (data.order_hash!=undefined) {
                    key_order_form.children('[name="ik_baggage_fields"]').val(data.order_hash);
                }
                key_order_form.submit();
            }
            else {
                alert('error');
                if (data.redirect!=undefined) {
                    window.location.href=data.redirect;
                }
            }
        },
        'json'
    );
});


