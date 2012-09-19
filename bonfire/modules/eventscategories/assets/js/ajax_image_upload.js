$('#image_upload_form').ajaxForm(
    {
        dataType: 'json',
        success: function (data) {
            if (data.success) {
                $('#image_upload_notification').removeClass('error')
                                               .addClass('success')
                                               .removeAttr('style')
                                               .html(data.message);
                $('#image_preview').attr('src',data.image_url);
                $('#event_category_img').val(data.image);
            }
            else {
                $('#image_upload_notification').removeClass('success')
                                               .addClass('error')
                                               .removeAttr('style')
                                               .html(data.message);
            }
        }
    }
);
    
$('#image_browse').bind('click',
    function(){
        $('#image_upload_hidden_form_wrapper input:file').click();
    }
);
$('#image_upload').bind('click',
    function(){
        if ($('#image_upload_hidden_form_wrapper input:file').val()!='') {
            $('#image_upload_hidden_form_wrapper input:submit').click();
        }
    }
);    


